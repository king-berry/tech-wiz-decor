@extends('layouts.user_main')

@section('content')
 <!-- Phần địa chỉ -->
 <div class="mb-4">
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Địa chỉ</th>
                <th class="px-4 py-2">Tên</th>
                <th class="px-4 py-2">Địa chỉ chi tiết</th>
                <th class="px-4 py-2">Số điện thoại</th>
                <th class="px-4 py-2">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @if($addresses->isNotEmpty())
                @foreach ($addresses as $address)
                    <tr>
                        <td class="border px-4 py-2">
                            {{ $address->address }} - {{ $address->ward->name }}, {{ $address->ward->district->name }}, {{ $address->ward->district->province->name }}
                        </td>
                        <td class="border px-4 py-2">{{ $address->name }}</td>
                        <td class="border px-4 py-2">{{ $address->address }}</td>
                        <td class="border px-4 py-2">{{ $address->phone }}</td>
                        <td class="border px-4 py-2">
                            {{-- <a href="{{ route('address.edit', $address->id) }}" class="text-blue-500">Chỉnh sửa</a> --}}
                            @if ($address->default == 0)
                            <form action="{{ route('address.default', $address->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="default-button confirmation-button" onclick="return confirm('Bạn có chắc chắn muốn chọn địa chỉ này là mặc định chứ ?');">
                                    Đặt mặc định
                                </button>
                            </form>
                        @else
                            <span class="default-text">Đang là mặc định</span>
                        @endif                        
                            <form action="{{ route('address.destroy', $address->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này?');">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center py-4">Chưa có địa chỉ nào được lưu.</td>
                </tr>
            @endif
        </tbody>
    </table>
    <label class="block text-gray-700 font-bold mb-2">Nhập địa chỉ mới</label>
    <div class="flex gap-4">
        <form method="post" action="{{ route('address.updateAddress') }}">
            @csrf
        <div class="flex-1 min-w-[200px]">
            <select id="select1_address" name="province_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Chọn Tỉnh/Thành phố</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-1 min-w-[200px]">
            <select id="select2_address" name="district_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Chọn Quận/Huyện</option>
            </select>
        </div>
        <div class="flex-1 min-w-[200px]">
            <select id="select3_address" name="ward_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Chọn Phường/Xã</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="address">Địa chỉ chi tiết</label>
        <input type="text" id="address" name="address" class="form-control"
            value="{{ old('address') }}" required>
    </div>
    <div class="form-group">
    <label for="phone">Số điện thoại</label>
    <input type="text" id="phone" name="phone" class="form-control"
        value="{{ old('phone') }}" required>
</div>
<div class="form-group">
    <label for="name">Tên</label>
    <input type="text" id="name" name="name" class="form-control"
        value="{{ old('name') }}" required>
</div>

</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">thêm</button>
</div>
</form>
</div>
<!-- End Phần địa chỉ -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select1_address = document.getElementById('select1_address');
        const select2_address = document.getElementById('select2_address');
        const select3_address = document.getElementById('select3_address');
    
        if (select1_address) {
            select1_address.addEventListener('change', function() {
                const provinceId = this.value;
    
                select2_address.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
                select3_address.innerHTML = '<option value="">Chọn Phường/Xã</option>';
    
                if (provinceId) {
                    fetch(`/user/districts/${provinceId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = district.name;
                                select2_address.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching districts:', error));
                }
            });
        }
    
        if (select2_address) {
            select2_address.addEventListener('change', function() {
                const districtId = this.value;
    
                select3_address.innerHTML = '<option value="">Chọn Phường/Xã</option>';
    
                if (districtId) {
                    fetch(`/user/wards/${districtId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(ward => {
                                const option = document.createElement('option');
                                option.value = ward.id;
                                option.textContent = ward.name;
                                select3_address.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error fetching wards:', error));
                }
            });
        }
    });
    </script>
@endsection
