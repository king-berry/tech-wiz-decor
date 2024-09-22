@extends('layouts.admin_main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Thêm Sản Phẩm</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Tên Sản Phẩm -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Tên Sản Phẩm</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('name')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Giá -->
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('price')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Mô Tả -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Mô Tả</label>
            <textarea id="description" name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Số Lượng -->
        <div class="mb-4">
            <label for="qty" class="block text-sm font-medium text-gray-700">Số Lượng</label>
            <input type="number" id="qty" name="qty" min="0" value="{{ old('qty') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('qty')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

<!-- Danh Mục -->
<div class="mb-4">
    <label for="categories" class="block text-sm font-medium text-gray-700">Danh Mục</label>
    <select name="categories[]" id="categories"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('categories') == $category->id) selected @endif>
                            {{ $category->name}} {{$category->type}}</option>
                    @endforeach
                </select>
    <div class="mt-4">
        <button type="button" id="addCategoryButton" class="bg-pink-400 text-white px-4 py-1 rounded">Thêm Danh mục mới</button>
    </div>
    <div id="newCategoryFields" class="hidden mt-4">
        <label for="newCategoryName" class="block text-gray-700 font-bold mb-2">Tên danh mục</label>
        <input type="text" name="new_category_name" id="newCategoryName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

        <label for="newCategoryType" class="block text-gray-700 font-bold mb-2 mt-4">Loại danh mục</label>
        <input type="text" name="new_category_type" id="newCategoryType" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    @error('categories')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>


       <!-- Ảnh Sản Phẩm -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Ảnh Sản Phẩm</label>
            <input type="file" id="image" name="images[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple>
            @error('images')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>


        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Lưu</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addCategoryButton = document.getElementById("addCategoryButton");
        const newCategoryFields = document.getElementById("newCategoryFields");
        const categoriesSelect = document.getElementById("categories");

        function checkCategorySelection() {
            if (categoriesSelect.value === "") {
                newCategoryFields.classList.remove("hidden");
                newCategoryFields.classList.add("block");
            } else {
                newCategoryFields.classList.remove("block");
                newCategoryFields.classList.add("hidden");
            }
        }

        categoriesSelect.addEventListener("change", checkCategorySelection);

        addCategoryButton.addEventListener("click", function() {
            if (newCategoryFields.classList.contains("hidden")) {
                newCategoryFields.classList.remove("hidden");
                newCategoryFields.classList.add("block");
                categoriesSelect.value = ""; 
            } else {
                newCategoryFields.classList.remove("block");
                newCategoryFields.classList.add("hidden");
            }
        });
    });
</script>
@endsection
