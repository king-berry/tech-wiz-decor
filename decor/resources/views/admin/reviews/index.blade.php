@extends('layouts.admin_main')

@section('content')
@section('content')
<div class="flex justify-between my-6">
    <h1 class="font-bold text-2xl leading-7">Danh Sách Người Dùng Đánh Giá</h1>
</div>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Thành công!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Sản phẩm</th>
                <th>Đánh giá</th>
                <th>Nhận xét</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->orderDetail->order->address->user->name }}</td>
                    <td>{{ $review->orderDetail->product->name }}</td>
                    <td>
                        @for ($i = 0; $i < $review->rate; $i++)
                            <span class="fa fa-star checked"></span>
                        @endfor
                        @for ($i = $review->rate; $i < 5; $i++)
                            <span class="fa fa-star"></span>
                        @endfor
                    </td>
                    <td>{{ $review->text }}</td>
                    <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection