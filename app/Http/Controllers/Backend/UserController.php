<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Traits\Filesaver;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use Filesaver;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        Gate::authorize('app.user.index');
        $users = User::orderBy('created_at','DESC')->get();
        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.user.create');
        $roles = Role::all();
        return view('backend.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name'  => 'required',
            'email' => 'required|unique:users',
            'password'=>'required|min:8',
            'role'    =>'required',
            'image'  => 'sometimes|mimes:jpg,png|max:2048',
        ]);

       $user =  User::create([
            'role_id'   => $request->role,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'status'    => $request->filled('status'),
            'avatar'    => $request->avatar,
        ]);

         // <!-- update user image -->
        if($request->file('image')){
            $this->uploadFileWithResize($request->image, $user, 'image', 'user',250,250);
        }

        notify()->success("User Created");
        return redirect()->route('app.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('app.user.edit');
        $user = User::findOrfail($id);
        $roles = Role::all();
        return view('backend.user.create',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required',
            'password'=>'sometimes',
            'role'    =>'required',
            'image'  => 'sometimes|mimes:jpg,png|max:2048',
        ]);

        $user = User::findOrfail($id);
        $user->update([
            'role_id'   => $request->role,
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt(isset($request->password) ? $request->password : $user->password),
            'status'    => $request->filled('status'),
            'avatar'    => $request->avatar,
        ]);

        // <!-- update user image -->
        if($request->file('image')){
            $this->upload_file($request->image, $user, 'image', 'user',250,250);
        }

        notify()->success("User Updated");
        return redirect()->route('app.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('app.user.delete');
        $user = User::findOrfail($id);
        if(file_exists($user->image) && $user->image != '' && $user->deletable == true && Auth::user()->id != $user->id){
            
            unlink($user->image);
            $user->delete();
            return response()->json($user);
        }
    }
}
