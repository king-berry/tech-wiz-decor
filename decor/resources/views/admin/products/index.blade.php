@extends('layouts.admin_main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Danh Sách Sản Phẩm</h1>
    
    <a href="{{ route('admin.products.create') }}" class="bg-blue-500 text-white px-4 py-2 no-underline rounded">Thêm Sản Phẩm</a>
    @php
    $stt = 1;
    @endphp
   
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md mt-4">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Stt</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Tên</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Giá</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Số lượng</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Ngày Tạo</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td class="py-2 px-4 text-sm text-gray-700">{{$stt++}}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $product->name }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $product->price }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $product->qty }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $product->created_at->format('d/m/Y') }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">
                        <a href="{{ route('admin.products.show', $product->id) }}" class="text-blue-500 hover:text-blue-700">Xem</a> |
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-yellow-500 hover:text-yellow-700">Sửa</a> |
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-2 px-4 text-sm text-gray-700 text-center">Không có sản phẩm nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
