@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Image Uploader CSS -->
<link rel="stylesheet" href="{{asset('backend/dist/image-uploader.min.css')}}">
<!--Material Design Iconic Font-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endsection

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-primary"><i class="fa-solid px-1 fa-circle-check"></i>
            @if (isset($product))
                Product Update
            @else
                Products
            @endif
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item active" aria-current="page">
            @if (isset($product))
                Update
            @else
                List
            @endif
            </li>
        </ol>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <form action="{{!isset($product) ? route('app.product.store') : route('app.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($product))
                        @method('PUT')
                    @endif
                    
                    <div class="row">
                        <div class="col-7">
                            <div class="card-body">
                                <div class="form-group">
                                    <label style="color: #626262;" for="name"><strong>Name :</strong></label>
                                    <input class="form-control" id="name" name="name" value="{{isset($product) ? $product->name : old('name')}}" type="text"
                                    class="@error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="about"><strong>About :</strong></label>
                                    <textarea class="form-control" rows="6" id="about" name="about">{{isset($product) ? $product->about : old('about')}}</textarea>
                                    <small>Description should be less then 500 words.</small>
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="description"><strong>Description :</strong></label>
                                    <textarea class="form-control" rows="6" id="description" name="description">{{isset($product) ? $product->description : old('description')}}</textarea>
                                    <small>Description should be less then 500 words.</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="#" disabled selected hidden>Select</option>
                                        @foreach ($categories as $category)
                                          <option value="{{$category->id}}">{{$category->name}}</option>  
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="subcategory">Sub Category</label>
                                    <select class="form-control" id="subcategory">
                                       
                                    </select>
                                </div>


                                <div class="input-field">
                                    <label class="active">Photos</label>
                                    <div class="input-images"></div>
                                </div>


                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" @if(isset($product)) {{$product->status == 1 ? 'checked' : ''}} @endif id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Status</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 ml-4 mb-3">
                                @if (isset($product))
                                    <button type="submit" class="btn btn-primary">Update</button> 
                                @else
                                   <button type="submit" class="btn btn-primary">Create New</button> 
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('layouts.logoutmodal')
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Image Uploader Js -->
<script type="text/javascript" src="{{asset('backend/dist/image-uploader.min.js')}}"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.dropify').dropify();
        });

        $('.input-images').imageUploader();

        
        $("#category").on('change',function(){
            $("#subcategory").html('');
            var category_id = $(this).val();
            
            $.ajax({
                url         : '/app/product/select/subcategory/'+category_id,
                Type        : 'GET',
                dataType    : 'json',
                success     : function(response){
                    $.each(response,function(k,v){
                        var html = `
                        <option disable hidden selected>select one</option>
                        <option value='${v.id}'>${v.name}</option>
                        `;
                        $("#subcategory").append(html);
                    });
                },
            });
        });

        $("#subcategory").on('change',function(){
            var subcat =  $(this).val();
            console.log(subcat);
        });
       
</script>
@endsection