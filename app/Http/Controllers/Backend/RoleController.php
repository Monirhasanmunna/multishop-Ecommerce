<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.role.index');
        $roles = Role::all();
        return view('backend.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        Gate::authorize('app.role.create');
        $modules = Module::all();
        return view('backend.role.create',compact('modules'));
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
            'name'  => 'required|unique:roles',
            'description'   => 'sometimes',
        ]);

        Role::create([
            'name'  => $request->name,
            'description'   => $request->description,
            'slug'  => Str::slug($request->name),
        ])->permissions()->sync($request->input('permission'));

        notify()->success("Role Created");
        return redirect()->route('app.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('app.role.edit');
        $role = Role::findOrfail($id);
        $modules = Module::all();
        return view('backend.role.create',compact('modules','role'));
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
        //return $request->all();
        $request->validate([
            'name'  => 'required',
            'description'   => 'sometimes',
        ]);

        $role = Role::findOrfail($id);

        $role->update([
            'name'  => $request->name,
            'description'   => $request->description,
            'slug'  => Str::slug($request->name),
        ]);

        $role->permissions()->sync($request->input('permission'));
       
        notify()->success("Role Updated");
        return redirect()->route('app.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('app.role.delete');
        $role = Role::findOrfail($id);
        if($role->deletable == true){
            $role->delete();
            notify()->success("Role Deleted");
        }else{
            notify()->error("You Can Not Delete System Role");
        }

        return redirect()->back();
    }
}
