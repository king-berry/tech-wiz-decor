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
    @php
    $stt = 1;
    @endphp
    
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Stt</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Tên</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Email</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Trạng Thái</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Ngày Tạo</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $stt++ }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $user->name }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $user->email }}</td>
                    @if ($user->deleted_at === null)
                        <td class="py-2 px-4 text-sm text-gray-700">Đang hoạt động</td>
                    @else
                        <td class="py-2 px-4 text-sm text-gray-700">Dừng {{ $user->deleted_at->format('d/m/Y') }}</td>
                    @endif
                    <td class="py-2 px-4 text-sm text-gray-700">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="py-2 px-4 text-sm text-gray-700">
                        <a href="{{ route('admin.user.update', $user->id) }}" 
                           class="text-blue-500 hover:text-blue-700">
                            {{ $user->deleted_at === null ? 'Khóa' : 'Khôi phục' }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-2 px-4 text-sm text-gray-700 text-center">Không có người dùng nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
