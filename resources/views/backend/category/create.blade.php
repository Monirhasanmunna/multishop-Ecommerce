@extends('layouts.backend.main')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h4 mb-0 text-primary"><i class="fa-solid px-1 fa-circle-check"></i>
            @if (isset($category))
                Category Update
            @else
                Categories
            @endif
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Category</li>
            <li class="breadcrumb-item active" aria-current="page">
            @if (isset($category))
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
                <form action="{{!isset($category) ? route('app.category.store') : route('app.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($category))
                        @method('PUT')
                    @endif
                    
                    <div class="row">
                        <div class="col-7">
                            <div class="card-body">
                                <div class="form-group">
                                    <label style="color: #626262;" for="name"><strong>Name :</strong></label>
                                    <input class="form-control" id="name" name="name" value="{{isset($category) ? $category->name : old('name')}}" type="text"
                                    class="@error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="color: #626262;" for="description"><strong>Description :</strong></label>
                                    <textarea class="form-control" rows="6" id="description" name="description">{{isset($category) ? $category->description : old('email')}}</textarea>
                                    <small>Description should be less then 500 words.</small>
                                </div>
                            </div>
                        
                        </div>

                        <div class="col-5">
                            <div class="card-body">
                                <div class="form-group">
                                    <label style="color: #626262;" for="avatar"><strong>Category Image :</strong></label>
                                    <input class="form-control dropify" id="avatar" data-default-file="{{isset($category) ? asset($category->image) : ''}}" name="image" type="file"
                                    class="@error('image') is-invalid @enderror">

                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-3 ml-4 mb-3">
                                @if (isset($user))
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