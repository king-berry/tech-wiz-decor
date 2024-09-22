@extends('layouts.user_main')

@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Chỉnh sửa địa chỉ</h2>

    <form action="{{ route('address.updateAddress', $address->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Địa chỉ chi tiết:</label>
            <input type="text" id="address" name="address" value="{{ old('address', $address->address) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('address')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $address->phone) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('phone')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="province_id" class="block text-gray-700 text-sm font-bold mb-2">Tỉnh/Thành phố:</label>
            <select id="province_id" name="province_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Chọn Tỉnh/Thành phố</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}" {{ old('province_id', $address->ward->district->province->id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                @endforeach
            </select>
            @error('province_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="district_id" class="block text-gray-700 text-sm font-bold mb-2">Quận/Huyện:</label>
            <select id="district_id" name="district_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Chọn Quận/Huyện</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}" {{ old('district_id', $address->ward->district->id) == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                @endforeach
            </select>
            @error('district_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ward_id" class="block text-gray-700 text-sm font-bold mb-2">Phường/Xã:</label>
            <select id="ward_id" name="ward_id" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="">Chọn Phường/Xã</option>
                @foreach ($wards as $ward)
                    <option value="{{ $ward->id }}" {{ old('ward_id', $address->ward->id) == $ward->id ? 'selected' : '' }}>{{ $ward->name }}</option>
                @endforeach
            </select>
            @error('ward_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Cập nhật địa chỉ
            </button>
            
        </div>
    </form>
</div>
@endsection
