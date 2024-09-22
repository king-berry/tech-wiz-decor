@extends('layouts.admin_main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Chi Tiết Sản Phẩm</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <p><strong>Tên:</strong> {{ $product->name }}</p>
        <p><strong>Ảnh:
            @if($product->images->isNotEmpty())
                @php
                    $firstImage = $product->images->first();
                @endphp
                <img src="{{ asset('storage/' . $firstImage->image) }}" alt="Product Image" class="w-16 h-16 object-cover mb-2">
            @else
                Không có ảnh
            @endif
        </strong>   
        </p>    
        <p><strong>Giá:</strong> {{ $product->price }}</p>
        <p><strong>Mô tả:</strong> {{ $product->description }}</p>
        <p><strong>Số lượng:</strong> {{ $product->qty }}</p>
        <p><strong>Ngày Tạo:</strong> {{ $product->created_at->format('d/m/Y') }}</p>
        <p><strong>Ngày Cập Nhật:</strong> {{ $product->updated_at->format('d/m/Y') }}</p>
    </div>

    <a href="{{ route('admin.products.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Quay Lại</a>
</div>
@endsection
