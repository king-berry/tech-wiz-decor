@extends('layouts.admin_main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Danh Sách mã giảm giá</h1>
    
    <a href="{{ route('admin.vouchers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded no-underline">Thêm Voucher</a>
    
    @php
        $stt = 1; // Khởi tạo giá trị $stt từ 1
    @endphp
    
    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ $message }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md mt-4">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Stt</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Code</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Ratio</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Description</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Quantity</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vouchers as $voucher)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $stt++ }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $voucher->code }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $voucher->ratio }} %</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $voucher->description }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $voucher->qty }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">
                        <a href="{{ route('admin.vouchers.edit', $voucher->id) }}" class="text-yellow-500 hover:text-yellow-700">Sửa</a> |
                        <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
