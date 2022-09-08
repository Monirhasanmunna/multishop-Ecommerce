@extends('layouts.main')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-primary"><i class="fa-solid px-1 fa-circle-check"></i>
            @if (isset($subcategory))
                Sub Category Update
            @else
                Sub Categories
            @endif
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Sub Category</li>
            <li class="breadcrumb-item active" aria-current="page">
            @if (isset($subcategory))
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
                <form action="{{!isset($subcategory) ? route('app.subcategory.store') : route('app.subcategory.update',$subcategory->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($subcategory))
                        @method('PUT')
                    @endif
                    
                    <div class="row">
                        <div class="col-7">
                            <div class="card-body">
                                <div class="form-group">
                                    <label style="color: #626262;" for="name"><strong>Sub Category Name :</strong></label>
                                    <input class="form-control" id="name" name="name" value="{{isset($subcategory) ? $subcategory->name : old('name')}}" type="text"
                                    class="@error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="description"><strong>description :</strong></label>
                                    <textarea class="form-control" rows="5" id="description" name="description" type="text">{{isset($subcategory) ? $subcategory->description : old('description')}}</textarea>
                                </div>
                            </div>
                        
                        </div>

                        <div class="col-5">
                            <div class="card-body">
                                <div style="color: gray;" class="card-title">Role and Avatar select</div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="select"><strong>Role :</strong></label>
                                    <select class="js-example-basic-single" id="select" name="role">
                                        @foreach ($categories as $category)
                                          <option value="{{$category->id}}" 
                                            @if(isset($subcategory))
                                            {{$category->id == $subcategory->category_id ? 'selected' : ''}}
                                            @endif
                                            >{{$category->name}}</option>  
                                        @endforeach
                                      </select>
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="avatar"><strong>Avatar :</strong></label>
                                    <input class="form-control dropify" id="avatar" data-default-file="{{isset($subcategory) ? asset($subcategory->image) : ''}}" name="image" type="file"
                                    class="@error('avatar') is-invalid @enderror">

                                    @error('avatar')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3 ml-4 mb-3">
                                @if (isset($subcategory))
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection