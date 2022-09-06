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
                                                {{-- @if($user->status == true)
                                                    <span class="badge badge-primary">Avtive</span>
                                                @else
                                                    <span class="badge badge-danger">Deavtive</span>
                                                @endif --}}

                                                <div class="form-check form-switch">
                                                    <input class="form-check-input statusBtn" data-id="{{$user->id}}" type="checkbox" role="switch" data-size="small"  data-width="90" data-offstyle="danger" data-toggle="toggle" {{($user->status == true) ? 'checked' : ''}} data-off="Deactive" data-on="Active">
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn-sm btn-primary" href="{{Route('app.user.edit',$user->id)}}"><i class="fa fa-pen-to-square"></i></a>
                                                @if ($user->deletable == true)
                                                    <a class="btn-sm btn-danger" href="javaScript::void(0)" onclick="deleteUser({{$user->id}})"><i class="fa-solid fa-trash"></i></a> 
                                                @endif
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
    <input hidden id="authId" value="{{Auth::user()->id}}" type="number">
    @include('layouts.logoutmodal')
</div>
@endsection

@section('js')
    
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    function deleteUser(id){
        var authId = $("#authId").val();
        console.log(authId);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed && authId != id) {
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )

                $.ajax({
                    url     : '/app/user/delete/'+id,
                    type    : 'Delete',
                    dataType: 'json',
                });

                location.reload(true);
            }else{
                Swal.fire(
                'Oops!',
                'You Can Not Delete Yourself.',
                'error'
                )
            }
        })
    }

    $(".statusBtn").on('change',function(){

        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/app/user/status/update',
            data: {'status': status, 'user_id': user_id},
            success : function(){
                Swal.fire({
                        toast : true,
                        width : '20em',
                        timerProgressBar  : true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Status Updated Successfully',
                        showConfirmButton: false,
                        timer: 3000,
                      });
            }
        });
    });
    
    
</script>
@endsection