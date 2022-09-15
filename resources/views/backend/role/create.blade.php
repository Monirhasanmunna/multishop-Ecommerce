@extends('layouts.backend.main')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-primary"><i class="fa-solid fa-circle-check"></i>
        @isset($role)
            Role Update
        @else
            Role Create
        @endisset
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Roles</li>
            <li class="breadcrumb-item active" aria-current="page">
            @isset($role)
                Update
            @else
                Create
            @endisset
            </li>
        </ol>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <form action="{{!isset($role) ? route('app.role.store') : route('app.role.update',[$role->id])}}" method="POST">
                    @csrf
                    @if (isset($role))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <label style="color: #626262;" for="roles">Role Name :</label>
                            <input class="form-control" id="roles" name="name" value="{{isset($role) ? $role->name : old('name')}}" type="text"  class="@error('name') is-invalid @enderror">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label style="color: #626262;" for="description">Role Description :</label>
                            <textarea class="form-control" id="description" rows="5" name="description" value="{{isset($role) ? $role->description : old('description')}}" type="text"></textarea>
                        </div>

                        <div class="text-center mb-4 pt-2">
                            <strong>Manage Role Permission</strong>
                           <hr>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox"  id="select-all">
                            <label class="form-check-label" for="select-all" >Select All</label>
                        </div>

                        @forelse ($modules->chunk(2) as $key => $chunk)
                            <div class="row">
                                @foreach ($chunk as $module)
                                    <div class="col">
                                        <h5>Module : {{$module->name}}</h5>
                                        @foreach ($module->permissions as $permission)
                                            <div class="mb-3 ml-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="permission[]" value="{{$permission->id}}"
                                                    @if(isset($role))
                                                    @foreach ($role->permissions as $rolePermissions)
                                                        {{$rolePermissions->id == $permission->id ? 'checked' : ''}}
                                                    @endforeach
                                                    @endif
                                                    >
                                                    <label class="form-check-label" for="flexCheckDefault" >{{$permission->name}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            
                        @empty
                            <div class="row">
                                <div class="col">
                                    <strong>No Module Found.</strong>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-3 ml-4 mb-3">
                        @if (isset($role))
                            <button type="submit" class="btn btn-primary">Update</button> 
                        @else
                           <button type="submit" class="btn btn-primary">Create</button> 
                        @endif
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.logoutmodal')
@endsection

@section('js')
    <script>
        $('#select-all').click(function(event){

            if(this.checked) {
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            }else{
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }

        });
    </script>
@endsection