@extends('layouts.frontend.main')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @if(session('cart'))
                            @foreach (session('cart') as $key => $cart)
                                <tr>
                                    <td class="align-middle"><img src="{{asset($cart['images']['image'])}}" alt="" style="width: 50px; padding:5px"><span class="pname">{{$cart['name']}}</span></td>
                                    <td hidden><input class="price" hidden type="number" value="{{$cart['price']}}"></td>
                                    <td class="align-middle">${{$cart['price']}}</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus" >
                                                <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="qty[]" class="form-control form-control-sm bg-secondary border-0 text-center qty" value="1">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus ">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">$<span class="sum">{{$cart['price']}}</span></td>
                                    <td class="align-middle"><button onclick="deleteCart({{$cart['product_id']}})" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$<span class="subTotal">150</span></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$<span class="shipping_cost">10</span></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>$<span class="total">160</span></h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('js')
        <script>
            $(document).ready(function(){
                $('.btn-plus').on('click',function(){
                    var price = $(this).closest('tr').find('.price').val();
                    var qty = $(this).parent('div').closest('tr').find('.qty').val();
                    var subtotal = parseInt(qty)*parseInt(price);
                    $(this).closest('tr').find('.sum').text(subtotal);

                    calculation();
                });

                $('.btn-minus').on('click',function(){
                    var price = $(this).closest('tr').find('.price').val();
                    var qty = $(this).parent('div').closest('tr').find('.qty').val();
                    var subtotal = parseInt(qty)*parseInt(price);
                    $(this).closest('tr').find('.sum').text(subtotal);

                    calculation();
                });

                $('.qty').on('keyup',function(){
                    var price = $(this).closest('tr').find('.price').val();
                    var qty = $(this).parent('div').closest('tr').find('.qty').val();
                    var subtotal = parseInt(qty)*parseInt(price);
                    $(this).closest('tr').find('.sum').text(subtotal);

                    calculation();
                });


                function calculation(){
                    var total = 0;
                    $('.sum').each(function(index,item){
                        let subTotal = $(item).text();
                        total += Number(subTotal);
                    });
                    var shippingCost = $('.shipping_cost').text();
                    $('.subTotal').text(total);
                    $('.total').text(total+parseInt(shippingCost));
                }

                calculation();
            });

            //Delete Cart Item
            function deleteCart(id){
                $.ajax({
                    url       : '/multishop/delete_cart/'+id,
                    type      : 'GET',
                    dataType  : 'json',
                    success   : function(response){
                        location.reload(true);
                        $('.cart').text(response);
                    },
                    error     : function(error){
                        console.log(error);
                    },
                });
            }
        </script>
        
@endsection