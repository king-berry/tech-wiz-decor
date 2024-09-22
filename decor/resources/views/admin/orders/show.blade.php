@extends('layouts.admin_main')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Chi Tiết Đơn Hàng</h1>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        <div class="mb-4">
            <h2 class="text-lg font-bold">Thông tin đơn hàng</h2>
            <p><strong>Tên khách hàng:</strong> {{ $order->address->user->name }}</p>
            <p><strong>Địa chỉ:</strong> {{ $order->address->address }}</p>
            <p><strong>Giá:</strong> ${{ $order->price }}</p>
            <p><strong>Địa chỉ giao hàng: </strong> {{ $order->address->ward->name }} - {{ $order->address->ward->district->name }} - {{ $order->address->ward->district->province->name }}</p>
            <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p><strong>Trạng thái: </strong>
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
            </p>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-bold">Danh sách sản phẩm</h2>
            @if($order->orderDetails && $order->orderDetails->count())
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Tên sản phẩm</th>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Hình ảnh</th>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Giá</th>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td class="py-2 px-4 text-sm text-gray-700">{{ $detail->product->name }}</td>
                                <td class="py-2 px-4 text-sm text-gray-700">
                                    @if($detail->product->images->count())
                                        <img src="{{ asset('storage/' . $detail->product->images->first()->image) }}" alt="{{ $detail->product->name }}" class="img-fluid" style="max-width: 100px;">
                                    @else
                                        Không có ảnh
                                    @endif
                                </td>
                                <td class="py-2 px-4 text-sm text-gray-700">${{ $detail->price }}</td>
                                <td class="py-2 px-4 text-sm text-gray-700">{{ $detail->qty }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Không có sản phẩm nào trong đơn hàng này.</p>
            @endif
        </div>

        <div class="mb-4">
            @if($order->status < 3)
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700">
                        Cập nhật trạng thái đơn hàng
                    </button>
                </form>
            @endif
        </div>
        <a href="{{ route('admin.orders.index') }}" class="ml-4 text-blue-600 hover:text-blue-900 font-semibold">Quay lại danh sách</a>
    </div>
</div>
@endsection
