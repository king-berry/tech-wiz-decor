@extends('layouts.user_auth')

@section('content')
<div class="space-y-8">
    <h1 class="text-3xl font-bold text-center text-gray-900">Login</h1>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('account.postLogin') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if(session('errors'))
                <div class="text-red-500 text-xs">
                    {{ session('errors')->first('login') }}
                </div>
            @endif

            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Login</button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">Chưa có tài khoản?</p>
            <a href="{{ route('account.register') }}" class="text-blue-500 hover:text-blue-700">Tạo tài khoản mới</a>
        </div>
    </div>
</div>
@endsection
