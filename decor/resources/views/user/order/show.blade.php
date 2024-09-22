@extends('layouts.user_main')

@section('content')
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Chi tiết đơn hàng</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <h3>Thông tin đơn hàng</h3>
            <p><strong>Mã số đơn hàng:</strong> {{ $order->code }}</p> <!-- Sử dụng code thay vì id -->
            <p><strong>Ngày:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Tổng tiền:</strong> ${{ $order->price }}</p>
            <p class="card-text">Trạng thái:
                @if ($order->status == 1)
                    <span class="badge bg-warning text-dark">Đang xử lý</span>
                @elseif ($order->status == 2)
                    <span class="badge bg-primary"><strong>Đơn hàng của bạn đang được giao đến, vui lòng chú ý điện
                            thoại!</strong></span>
                @elseif ($order->status == 3)
                    <span class="badge bg-success">Đã giao hàng</span>
                @elseif ($order->status == 4)
                    <span class="badge bg-danger">Đã hủy</span>
                @elseif ($order->status == 5)
                    <span class="badge bg-success">Đã nhận hàng</span>
                @endif
            </p>
            <h3>Chi tiết sản phẩm</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($order->orderDetails && $order->orderDetails->count())
                        @foreach ($order->orderDetails as $detail)
                            <tr>
                                <td>{{ $detail->product->name }}</td>
                                <td>
                                    @if ($detail->product->images)
                                        <img src="{{ asset('storage/' . $detail->product->images?->first()->image) }}"
                                            alt="{{ $detail->product->name }}" class="img-fluid" style="max-width: 100px;">
                                    @else
                                        Không có ảnh
                                    @endif
                                </td>
                                <td>${{ $detail->price }}</td>
                                <td>{{ $detail->qty }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">Không có sản phẩm nào trong đơn hàng này.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @if ($order->status == 1)
                <form action="{{ route('order.destroy', $order->code) }}" method="POST"
                    onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mt-3">Hủy đơn hàng</button>
                </form>
            @elseif($order->status == 3)
                <form action="{{ route('order.confirmReceipt', $order->code) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success mt-3">Xác nhận đã nhận hàng</button>
                </form>
            @elseif($order->status == 5)
            <h2>Đánh giá chất lượng sản phẩm</h2>
            <form action="{{ route('review.store') }}" method="POST">
                @csrf
                <input type="hidden" name="order_detail_id" value="{{ $order->orderDetails->first()->id }}">
                <div class="form-group">
                    <label for="rate">Đánh giá:</label>
                    <select name="rate" id="rate" class="form-control" required>
                        <option value="1">1 sao</option>
                        <option value="2">2 sao</option>
                        <option value="3">3 sao</option>
                        <option value="4">4 sao</option>
                        <option value="5">5 sao</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="text">Nhận xét:</label>
                    <textarea name="text" id="text" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Gửi đánh giá</button>
            </form>
        @endif
        </div>
    </div>
@endsection
