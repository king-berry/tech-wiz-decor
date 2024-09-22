@extends('layouts.user_main')

@section('content')
    <div class="container1">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-image-container">
                    <img id="main-image" src="{{ asset('storage/' . $product->images->first()->image) }}" alt="Product Image"
                        class="img-fluid main-image">
                    <button id="prev-button" class="arrow-button">&#8249;</button>
                    <button id="next-button" class="arrow-button">&#8250;</button>
                </div>
                <div class="thumbnail-images">
                    @foreach ($product->images as $index => $image)
                        <img src="{{ asset('storage/' . $image->image) }}" alt="Product Thumbnail" class="thumbnail-image"
                            data-index="{{ $index }}">
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="product-name">Tên Sản Phẩm: {{ $product->name }}</h1>
                <p class="product-quantity">Số Lượng trong kho: {{ $product->qty }}</p>
                <p class="product-description">Mô Tả: {{ $product->description }}</p>
                <p class="product-price">Giá: <strong>{{ number_format($product->price, 0, ',', '.') }}.000 đ</strong></p>
                <button class="add-to-cart" data-product-id="{{ $product->id }}">
                    <span class="icon-cross">
                       <img src="{{ asset('images/cart.svg') }}" class="img-fluid"> Mua ngay
                    </span>
                </button>
            </div>
        </div>
    </div>
        <div class="wrap-container">
            <!-- Sản phẩm khác -->
            <div class="related-products-section mt-5">
                <h2 class="related-products-title">Sản phẩm khác</h2>
                <div class="row">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-12 col-md-4 col-lg-3 mb-5">
                            <a class="product-item" href="{{ route('products.show', $relatedProduct->id) }}">
                                @if ($relatedProduct->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $relatedProduct->images->first()->image) }}"
                                        alt="Product Image" class="img-fluid product-thumbnail">
                                @else
                                    Không có ảnh
                                @endif
                                <h3 class="product-title">{{ $relatedProduct->name }}</h3>
                                <strong class="product-price">{{ number_format($relatedProduct->price, 0, ',', '.') }}.000 đ</strong>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="reviews-section mt-5">
                <h1 class="reviews-title">Đánh giá sản phẩm</h1>
                @forelse ($reviews as $review)
                    <div class="review-item mb-3">
                        <p class="review-author"><strong>{{ $review->orderDetail->order->address->user->name }}</strong> ({{ $review->created_at->format('d/m/Y H:i') }})</p>
                        <p class="review-rating">
                            Đánh giá: 
                            @for ($i = 0; $i < $review->rate; $i++)
                                <span class="fa fa-star checked"></span>
                            @endfor
                            @for ($i = $review->rate; $i < 5; $i++)
                                <span class="fa fa-star"></span>
                            @endfor
                        </p>
                        <p class="review-product">Sản phẩm : {{ $review->orderDetail->product->name }}</p>
                        <p class="review-text">Nhận xét: {{ $review->text }}</p>
                    </div>
                @empty
                    <p>Chưa có đánh giá cho sản phẩm này.</p>
                @endforelse
            </div>
        </div>

@endsection

<style>
    .wrap-container {
      width: 80% ;
      margin: 0 auto;   
      border-top: 1px solid #ccc;
      margin-top: 50px;
    }
    .container1 {
        margin-top: 50px;
    }

    .main-image-container {
        position: relative;
        text-align: center;
    }

    .main-image {
        width: 100%;
        max-height: 500px;
        object-fit: contain;
    }

    .thumbnail-images {
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }

    .thumbnail-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        margin: 0 5px;
        border: 2px solid transparent;
    }

    .thumbnail-image.active {
        border-color: #000;
    }

    .arrow-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        padding: 10px;
        cursor: pointer;
        font-size: 18px;
        border-radius: 50%;
    }

    #prev-button {
        left: 10px;
    }

    #next-button {
        right: 10px;
    }

    .reviews-section {
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #ccc;
    }

    .reviews-title {
        font-weight: bold;
        margin-bottom: 15px;
        margin-top: 15px;
        color: black ;
    }

    .review-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .review-author {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .review-rating .fa-star {
        color: #d3d3d3;
    }

    .review-rating .fa-star.checked {
        color: #f5c518;
    }

    .review-product {
        font-style: italic;
        margin-top: 5px;
    }

    .review-text {
        margin-top: 5px;
    }

    .product-name, .product-quantity, .product-description, .product-price {
        margin-bottom: 10px;
    }

    .add-to-cart {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .add-to-cart:hover {
        background-color: #0056b3;
    }

    .related-products-section {
        margin-top: 30px;
    }

    .related-products-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .product-item {
        display: block;
        text-align: center;
        color: #333;
        text-decoration: none;
    }

    .product-thumbnail {
        width: 100%;
        height: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .product-title {
        font-size: 1.25rem;
        margin-top: 10px;
        margin-bottom: 5px;
    }

    .product-price {
        font-size: 1.125rem;
        color: #333;
    }   
    .fa-star {
        color: #d3d3d3;
    }

    .fa-star.checked {
        color: #f5c518;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentIndex = 0;
        const mainImage = document.getElementById('main-image');
        const thumbnails = document.querySelectorAll('.thumbnail-image');
        const totalImages = thumbnails.length;
        const addToCartButtons = document.querySelectorAll('.add-to-cart');

        function updateMainImage(index) {
            const newSrc = thumbnails[index].getAttribute('src');
            mainImage.setAttribute('src', newSrc);
            thumbnails.forEach(thumbnail => thumbnail.classList.remove('active'));
            thumbnails[index].classList.add('active');
        }

        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', function() {
                currentIndex = index;
                updateMainImage(index);
            });
        });

        document.getElementById('prev-button').addEventListener('click', function() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : totalImages - 1;
            updateMainImage(currentIndex);
        });

        document.getElementById('next-button').addEventListener('click', function() {
            currentIndex = (currentIndex < totalImages - 1) ? currentIndex + 1 : 0;
            updateMainImage(currentIndex);
        });

        updateMainImage(currentIndex);
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const productId = this.getAttribute('data-product-id');

                fetch('/add-to-cart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            productId: productId
                        })
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
