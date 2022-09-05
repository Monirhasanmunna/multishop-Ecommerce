@extends('layouts.main')

@section('css')
    <style>
        .image{
            width:45px;
            height:45px;
            padding: 2px;
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-primary"><i class="fa-solid fa-circle-check"></i>Users</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active" aria-current="page">list</li>
        </ol>
    </div>
    <!-- Row -->
    <div class="row">
        <!-- DataTable with Hover -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <div id="dataTableHover_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table align-items-center table-flush table-hover dataTable"id="dataTableHover" role="grid" aria-describedby="dataTableHover_info">
                                    <thead class="thead-light">
                                        <tr role="row" class="text-center">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTableHover"rowspan="1" colspan="1" aria-sort="ascending"aria-label="Name: activate to sort column descending">SL</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Position: activate to sort column ascending">Image</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Office: activate to sort column ascending">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Role</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Start date: activate to sort column ascending">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Start date: activate to sort column ascending">Status</th>
                                            <th class="sorting " tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Salary: activate to sort column ascending">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($users as $key=>$user)
                                        <tr role="row" class="odd text-center">
                                            <td class="sorting_1">{{$key+1}}</td>
                                            <td><img class="image" src="{{isset($user->image)? asset($user->image) : asset('storage/defualt/default.png')}}" alt="{{$user->image}}" srcset=""></td>
                                            <td>{{$user->name}}</td>
                                            <td><span class="badge badge-primary">{{$user->role->name}}</span></td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if($user->status == true)
                                                    <span class="badge badge-primary">Avtive</span>
                                                @else
                                                    <span class="badge badge-danger">Deavtive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn-sm btn-primary" href="{{Route('app.user.edit',$user->id)}}"><i class="fa fa-pen-to-square"></i></a>
                                                <a class="btn-sm btn-danger" href="{{Route('app.user.delete',$user->id)}}"><i class="fa-solid fa-trash"></i></a> 
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->

    @include('layouts.logoutmodal')
</div>
@endsection