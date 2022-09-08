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
        <h1 class="h4 mb-0 text-primary"><i class="fa-solid px-1 fa-circle-check"></i>Color</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Color</li>
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
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Office: activate to sort column ascending">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Product Count</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Start date: activate to sort column ascending">Updated At</th>
                                            <th class="sorting " tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Salary: activate to sort column ascending">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($colors as $key=>$color)
                                        <tr role="row" class="odd text-center">
                                            <td class="sorting_1">{{$key+1}}</td>
                                            <td>{{$color->name}}</td>
                                            <td><span class="badge badge-primary">0</span></td>
                                            <td>{{$color->updated_at->diffForHumans()}}</td>
                                            <td>
                                                <a class="btn-sm btn-primary" href="{{Route('app.color.edit',$color->id)}}"><i class="fa fa-pen-to-square"></i></a>
                                                <a class="btn-sm btn-danger" href="javaScript::void(0)" onclick="deleteUser({{$color->id}})"><i class="fa-solid fa-trash"></i></a> 
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
    {{-- <input hidden id="authId" value="{{Auth::user()->id}}" type="number"> --}}
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
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                    Swal.fire(
                    'Deleted!',
                    'Color has been deleted.',
                    'success'
                    )
                $.ajax({
                    url     : '/app/color/delete/'+id,
                    type    : 'Delete',
                    dataType: 'json',
                });

                location.reload(true);
            }
        })
    }

    // $(".statusBtn").on('change',function(){

    //     var status = $(this).prop('checked') == true ? 1 : 0; 
    //     var user_id = $(this).data('id'); 
         
    //     $.ajax({
    //         type: "GET",
    //         dataType: "json",
    //         url: '/app/user/status/update',
    //         data: {'status': status, 'user_id': user_id},
    //         success : function(){
    //             Swal.fire({
    //                     toast : true,
    //                     width : '20em',
    //                     timerProgressBar  : true,
    //                     position: 'top-end',
    //                     icon: 'success',
    //                     title: 'Status Updated Successfully',
    //                     showConfirmButton: false,
    //                     timer: 3000,
    //                   });
    //         }
    //     });
    // });
    
    
</script>
@endsection