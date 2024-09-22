@extends('layouts.user_main')

@section('content')
    <!-- Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Shop</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <!-- You can add additional content here if needed -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Product Section -->
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                <!-- Start Column 4 -->
                @foreach ($products as $product)
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                        <!-- Liên kết đến trang chi tiết sản phẩm -->
                        <a class="product-item" href="{{ route('products.show', $product->id) }}">
                            <!-- Hiển thị hình ảnh sản phẩm -->
                            @if($product->images->isNotEmpty())
                                @php
                                    $firstImage = $product->images->first();
                                @endphp
                                <img src="{{ asset('storage/' . $firstImage->image) }}" alt="Product Image" class="img-fluid product-thumbnail">
                            @else
                                Không có ảnh
                            @endif
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <strong class="product-price">{{ number_format($product->price, 0, ',', '.') }}.000 đ</strong>
                        </a>
                        <button class="add-to-cart" data-product-id="{{ $product->id }}">
                            <span class="icon-cross">
                                <img src="{{ asset('images/cart.svg') }}" class="img-fluid">
                            </span>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                
                const productId = this.getAttribute('data-product-id');

                fetch('/add-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ productId: productId })
                })
                .then(response => response.json())
                .then(data => {
                    const cartCountElement = document.querySelector('.cart-count');
                    cartCountElement.textContent = data.cartCount;
                    cartCountElement.style.display = 'block'; 
                })
                .catch(error => console.error('Error:', error));

                window.location.href = "{{ route('cart.index') }}";
            });
        });
    });
</script>
