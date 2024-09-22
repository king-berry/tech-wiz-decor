@extends('layouts.user_main')

@section('content')
<div class="container1">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action">Chỉnh sửa thông tin cá nhân</a>
                <a href="{{ route('profile.address') }}" class="list-group-item list-group-item-action">Địa chỉ</a>
                <a href="{{ route('order.index') }}" class="list-group-item list-group-item-action">Đơn Hàng Của tôi</a>
                <a href="{{ route('account.logout') }}" class="list-group-item list-group-item-action">Đăng xuất</a>
            </div>
        </div>
        <div class="col-md-9">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Chỉnh sửa thông tin cá nhân</div>
                <div class="card-body">
                    <form action="{{ route('profile.update', Auth::id()) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr>
                        <h5>Đổi mật khẩu</h5>
                        <div class="form-group">
                            <label for="current_password">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                            @error('current_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                            @error('new_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

<style>
    .container1 {
        margin-top: 50px;
    }
    .list-group {
        margin-bottom: 20px;
    }
    .list-group-item {
        cursor: pointer;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
    .card {
        margin-bottom: 20px;
    }
    .text-danger {
        color: red;
    }
    .btn-primary {
        margin-top: 20px;
    }
    .col-md-3 {
        border-radius: 2rem;
    }
    .flex {
    display: flex;
}


</style>
