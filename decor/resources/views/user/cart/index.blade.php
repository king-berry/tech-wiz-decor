@extends('layouts.user_main')

@section('content')

<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-lg-7">
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $details)
                            <tr>
                                <td class="product-thumbnail">
                                    @if(isset($details['image']) && $details['image'])
                                        <img src="{{ asset('storage/'.$details['image']) }}" alt="{{ $details['name'] }}" class="img-fluid">
                                    @else
                                        Không có ảnh
                                    @endif
                                </td>
                                
                                <td class="product-name">
                                    <h2 class="h5 text-black">{{ $details['name'] }}</h2>
                                </td>
                                <td>${{ $details['price'] }}</td>
                                <td>
                                    <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                                        </div>
                                        <input type="text" id="quantity-{{ $id }}" class="form-control text-center quantity-amount" value="{{ $details['quantity'] }}" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-black increase" type="button">&plus;</button>
                                        </div>
                                    </div>
                                    <td id="total-{{ $id }}">${{ $details['price'] * $details['quantity'] }}</td>                                    
                                <td><a href="#" class="btn btn-black btn-sm">X</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button class="btn btn-black btn-sm btn-block">Update Cart</button>
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-outline-black btn-sm btn-block" href="{{route('cart.checkout')}}">Tiếp tục mua hàng</a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection
