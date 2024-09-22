@extends('layouts.admin_main')

@section('content')
    <h1>Chỉnh sửa màu nền</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.configs.updateBackgroundColor') }}" method="POST">
        @csrf
        @method('PUT')
        <label for="color">Chọn màu:</label>
        <input type="color" id="color" name="color" value="{{ $color->value ?? '#3b5d50' }}">
        <button type="submit">Lưu</button>
    </form>
@endsection
