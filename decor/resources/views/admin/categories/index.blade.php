@extends('layouts.admin_main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Danh Mục Sản Phẩm</h1>
    
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Thành công!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    <a href="{{ route('admin.categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Thêm Danh Mục</a>
    
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">ID</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Tên</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Loại</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Ngày Tạo</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Ngày Cập Nhật</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $category->id }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $category->name }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $category->type }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $category->created_at->format('d/m/Y') }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $category->updated_at->format('d/m/Y') }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-500 hover:text-blue-700">Chỉnh sửa</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-2 px-4 text-sm text-gray-700 text-center">Không có thể loại nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
