@extends('layouts.main')

@section('css')
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet">
@endsection
@section('content')

        <div class="container-fluid pb-5">
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
        <div class="main-card card">
            <div class="row p-xl-4">
                <div class="col-lg-5 mb-30">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->images as $productImage)
                              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img class="d-block w-100" src="{{asset($productImage->image)}}" alt="{{$productImage->image}}">
                              </div>  
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                </div>
    
                <div class="col-lg-7 h-auto mb-30">
                    <div class="h-100 bg-light p-30">
                        <h3>{{$product->name}}</h3>
                        <div class="d-flex mb-1 mt-4">
                            <strong class="text-dark mr-3">Price:</strong>
                                <div class="d-inline">
                                    <p class="h3"><strong>${{$product->price}}</strong></p>
                                </div>
                        </div>

                        <div class="d-flex mb-1">
                            <strong class="text-dark mr-3">Offer Price:</strong>
                                <div class="d-inline">
                                    @if (isset($product->offer_price))
                                      <p ><strong>${{$product->offer_price}}</strong></p>
                                    @else
                                    <p><strong>N/A</strong></p>
                                    @endif
                                    
                                </div>
                        </div>

                        <p class="mb-4">{{$product->about}}</p>

                        <div class="d-flex mb-1">
                            <strong class="text-dark mr-3">Category:</strong>
                                <div class="d-inline">
                                    <p>{{$product->category->name}}</p>
                                </div>
                        </div>

                        <div class="d-flex mb-1">
                            <strong class="text-dark mr-3">Sub Category:</strong>
                                <div class="d-inline">
                                    <p>{{$product->subcategory->name}}</p>
                                </div>
                        </div>

                        <div class="d-flex mb-1">
                            <strong class="text-dark mr-3">Size:</strong>
                            @foreach ($product->sizes as $productSize)
                                <div class="d-inline">
                                    <p>{{$productSize->name}} , </p>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex mb-1">
                            <strong class="text-dark mr-3">Colors:</strong>
                            @foreach ($product->colors as $productColor)
                                <div class="d-inline">
                                    <p>{{$productColor->name}},</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex mb-4">
                            <strong class="text-dark mr-3">Quantity:</strong>
                            <div class="d-inline">
                                <h5>{{$product->quantity}} <small>{{$product->unit->name}}.</small></h5>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <strong class="text-dark mr-3">Status:</strong>
                            <div class="d-inline">
                                @if ($product->status == true)
                                    <h5><span class="badge badge-primary">Active</span></h5>
                                @else
                                    <h5><span class="badge badge-info">Deactive</span></h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <div class="px-4">
                        <strong>Description:</strong>
                        <p class="pt-1">{{$product->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Template Javascript -->
    <script src="{{asset('backend/js/main.js')}}"></script>
@endsection