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
        <h1 class="h4 mb-0 text-primary"><i class="fa-solid px-1 fa-circle-check"></i>Product</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Product</li>
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
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Category</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Subcat</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Price</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Offer Price</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Color</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Size</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Qty</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Age: activate to sort column ascending">Status</th>
                                            <th class="sorting " tabindex="0" aria-controls="dataTableHover" rowspan="1"colspan="1" aria-label="Salary: activate to sort column ascending">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($products as $key=>$product)
                                        <tr role="row" class="odd text-center">
                                            <td class="sorting_1">{{$key+1}}</td>
                                            <td>
                                                @foreach ($product->images as $images)
                                                    @if ($loop->first)
                                                        <img class="image" src="{{asset($images->image)}}" alt="" srcset="">   
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->category->name}}</td>
                                            <td>{{$product->subcategory->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->offer_price}}</td>
                                            <td>
                                                @foreach ($product->colors as $items)
                                                    <span class="badge badge-primary">{{$items->name}}</span>  
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($product->sizes as $items)
                                                    <span class="badge badge-primary">{{$items->name}}</span>
                                                @endforeach
                                            </td> 
                                            <td>{{$product->quantity}}</td>
                                            <td>
                                                @if ($product->status == true)
                                                    <span class="badge badge-primary">Publish</span>  
                                                @else
                                                    <span class="badge badge-danger">Un Publish</span>  
                                                @endif
                                            </td>
                                            <td>
                                                <a data-toggle="tooltip" data-placement="left" title="show" class="text-info" href="{{Route('app.product.show',$product->id)}}"><i class="fa-solid fa-eye"></i></a>
                                                <a data-toggle="tooltip" data-placement="left" title="edit" class="text-primary" href="{{Route('app.product.edit',$product->id)}}"><i class=" fa fa-pen-to-square"></i></a>
                                                <a data-toggle="tooltip" data-placement="left" title="delete" class="text-danger" href="javaScript::void(0)" onclick="deleteUser({{$product->id}})"><i class="fa-solid fa-trash"></i></a> 
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
        $(document).ready(function () {
            $('#example').DataTable({
                scrollX: true,
            });
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
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
                    'Product has been deleted.',
                    'success'
                    )
                $.ajax({
                    url     : '/app/product/delete/'+id,
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