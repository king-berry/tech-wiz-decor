@extends('layouts.admin_main')

@section('content')
<div class="flex justify-between my-6">
    <h1 class="font-bold text-2xl leading-7">Danh Sách Người Dùng</h1>
</div>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Thành công!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead class="bg-gray-100 border-b border-gray-200">
            @php
                $stt = 1;
            @endphp
            <tr>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Stt</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Địa Chỉ</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Giá</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Trạng Thái</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Ngày Tạo</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td class="py-2 px-4 text-sm text-gray-700">{{$stt++ }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{$order->address->address }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{$order->price }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        @if($order->status == 1)
                            <span class="text-yellow-500">Đang xử lý</span>
                        @elseif($order->status == 2)
                            <span class="text-blue-500">Đang giao hàng</span>
                        @elseif($order->status == 3)
                            <span class="text-green-500">Đã giao hàng</span>
                        @elseif($order->status == 4)
                            <span class="text-red-500">Đã hủy</span>
                            @else($order->status == 5)
                            <span class="text-green-500">Người dùng đã nhận đơn hàng</span>
                        @endif
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info">Xem</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-2 px-4 text-sm text-gray-700 text-center">Không có người dùng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
