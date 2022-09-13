@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Image Uploader CSS -->
<link rel="stylesheet" href="{{asset('backend/dist/image-uploader.min.css')}}">
<!--Material Design Iconic Font-->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<style>
    .dropify-wrapper {
        height: 100px;
    }
</style>
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
                <form id='formData' action="{{!isset($product) ? route('app.product.store') : route('app.product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
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
                                    <textarea class="form-control" rows="5" id="about" name="about">{{isset($product) ? $product->about : old('about')}}</textarea>
                                    <small>Description should be less then 500 words.</small>
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="description"><strong>Description :</strong></label>
                                    <textarea class="form-control" rows="5" id="description" name="description">{{isset($product) ? $product->description : old('description')}}</textarea>
                                    <small>Description should be less then 500 words.</small>
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="image"><strong>Image :</strong></label>
                                    <input id="image" name="image[]" class="form-control" type="file" multiple  class="@error('image') is-invalid @enderror">
                                    <div class="pt-2" id="preview"></div>
                                    @if (isset($product))
                                    <div class="pt-2">
                                        <h6>Old Images :</h6>
                                        @foreach ($product->images as $image)
                                            <img style="width: 120px;height:120px;" src="{{asset($image->image)}}" alt="{{$image->image}}">
                                        @endforeach
                                        
                                    </div>
                                    @endif
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" name="category" class="@error('category') is-invalid @enderror">
                                        <option value="#" disabled selected hidden>Select One</option>
                                        @foreach ($categories as $category)
                                          <option value="{{$category->id}}"
                                            @if (isset($product))
                                                {{$product->category_id == $category->id ? 'selected' : ''}}
                                            @endif
                                            >{{$category->name}}</option>  
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="subcategory">Sub Category</label>
                                    <select class="form-control" name="subcategory" id="subcategory" class="@error('subcategory') is-invalid @enderror">
                                        @if(isset($product))
                                        @foreach ($subCategoryByProdact as $subcategory)
                                            <option {{$product->subcategory_id == $subcategory->id ? 'selected' : ''}} value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                        @endforeach  
                                        @endif
                                       {{-- data come from ajax --}}
                                    </select>
                                    @error('subcategory')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <select class="form-control" id="unit" name="unit">
                                        <option value="#" disabled selected hidden>Select One</option>
                                        @foreach ($units as $unit)
                                          <option value="{{$unit->id}}"
                                            @if (isset($product))
                                                {{$product->unit_id == $unit->id ? 'selected' : ''}}
                                            @endif
                                            >{{$unit->name}}</option>  
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="price"><strong>Price :</strong></label>
                                    <input class="form-control" id="price" name="price" value="{{isset($product) ? $product->price : old('price')}}" type="number"
                                    class="@error('price') is-invalid @enderror">

                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="offer_price"><strong>Offer Price :</strong></label>
                                    <input class="form-control" id="offer_price" name="offer_price" value="{{isset($product) ? $product->offer_price : old('offer_price')}}" type="number"
                                    class="@error('offer_price') is-invalid @enderror">

                                    @error('offer_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="pr-1">Size <strong>:</strong></label>
                                    @foreach ($sizes as $size)
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox"  name="size[]" class="form-check-input" value="{{$size->id}}"
                                                class="@error('size') is-invalid @enderror"
                                                @if (isset($product))
                                                @foreach ($product->sizes as $productSize)
                                                    {{$productSize->id == $size->id ? 'checked' : ''}}
                                                @endforeach
                                                @endif
                                                >{{$size->name}}
                                            </label>

                                            @error('size')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label class="pr-1">Color <strong>:</strong></label>
                                    @foreach ($colors as $color)
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="checkbox"  name="color[]" class="form-check-input" value="{{$color->id}}"
                                                class="@error('color') is-invalid @enderror"
                                                @if (isset($product))
                                                    @foreach ($product->colors as $productColor)
                                                        {{$productColor->id == $color->id ? 'checked' : ''}}
                                                    @endforeach
                                                @endif
                                                >{{$color->name}}
                                            </label>

                                            @error('color')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="qty"><strong>Quantity :</strong></label>
                                    <input class="form-control" id="qty" name="quantity" value="{{isset($product) ? $product->quantity : old('quantity')}}" type="number"
                                    class="@error('quantity') is-invalid @enderror">

                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" @if(isset($product)) {{$product->status == true ? 'checked' : ''}} @endif id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Status</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 ml-4 mb-3">
                                @if (isset($product))
                                    <button type="submit" class="btn btn-primary">Update</button> 
                                @else
                                   <button  type="submit" class="btn btn-primary">Create New</button> 
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
{{-- Javascript Image Preview Start Here--}}
<script>
    function previewImages() {

        var preview = document.querySelector('#preview');

        if (this.files) {
        [].forEach.call(this.files, readAndPreview);
        }

        function readAndPreview(file) {

        // Make sure `file.name` matches our extensions criteria
        if (!/\.(jpe?g|png)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
        } // else...
        
        var reader = new FileReader();
        
        reader.addEventListener("load", function() {
            var image = new Image();
            image.height = 100;
            image.title  = file.name;
            image.src    = this.result;
            preview.appendChild(image);
        });
        
        reader.readAsDataURL(file);
        
        }
    }

    document.querySelector('#image').addEventListener("change", previewImages);

</script>
{{-- Javascript Image Preview Ends Here--}}
    <script>
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

</script>
@endsection