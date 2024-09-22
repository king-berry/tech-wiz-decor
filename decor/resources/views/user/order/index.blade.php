@extends('layouts.user_main')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Danh Sách Đơn Hàng</h1>

    <form method="GET" action="{{ route('order.index') }}" class="mb-4">
        <div class="form-group">
            <label for="status">Lọc :</label>
            <select id="status" name="status" class="form-control" onchange="this.form.submit()">
                <option value="">Tất cả</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Đang giao hàng</option>
                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Đã giao hàng</option>
                <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>
    </form>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            Hiện tại bạn chưa có đơn hàng nào.
        </div>
    @else
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Mã đơn hàng:# {{ $order->code }}</h5>
                            <p class="card-text">Địa chỉ giao hàng: {{$order->address->ward->name}} - {{$order->address->ward->district->name}} - {{$order->address->ward->district->province->name}}</p>
                            <p class="card-text">Địa chỉ chi tiết :  {{ $order->address->address }}</p>
                            <p class="card-text">Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            <p class="card-text">Tổng tiền: <strong>${{ $order->price }}</strong></p>
                            <p class="card-text">Trạng thái: 
                               @if ($order->status == 1)
                                    <span class="badge bg-warning text-dark"><strong>Đang xử lý</strong></span>
                                @elseif ($order->status == 2)
                                    <span class="badge bg-primary"><strong>Đang giao hàng</strong></span>
                                @elseif ($order->status == 3)
                                    <span class="badge bg-success"><strong>Đã giao hàng</strong></span>
                                @elseif ($order->status == 4)
                                    <span class="badge bg-danger"><strong>Đã hủy</strong></span>       
                               @endif
                            </p>
                            <a href="{{ route('order.show', ['order' => $order->code])  }}" class="btn btn-primary btn-block">Chi tiết đơn hàng</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
