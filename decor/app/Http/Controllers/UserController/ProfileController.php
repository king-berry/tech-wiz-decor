<?php
namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Session::get('user'); 
        if (!$user) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }

        return view('user.profile.index', compact('user'));
    }
   
    public function update(Request $request)
    {
        $user = Session::get('user');
    
        if (!$user) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('profile.index')
                ->withErrors($validator)
                ->withInput();
        }
    
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
    
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->route('profile.index')
                    ->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.'])
                    ->withInput();
            }
    
            $user->password = Hash::make($request->input('new_password'));
        }
    
        $user->save();

        Session::put('user', $user);
        
        return redirect()->route('profile.index')
            ->with('success', 'Thông tin cá nhân và mật khẩu đã được cập nhật.');
    }
    public function address()
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        $addresses = Address::where('user_id', $user->id)->get();
        return view('user.profile.address', compact('user', 'provinces', 'districts', 'wards', 'addresses'));
    }
    public function addressEdit($id)
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        $address = Address::where('user_id', $user->id)->where('id', $id)->first();
        if (!$address) {
            return redirect()->route('profile.address')->with('error', 'Địa chỉ không tồn tại.');
        }
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        return view('user.profile.address-edit', compact('user', 'provinces', 'districts', 'wards', 'address'));
    }
    public function addressUpdate(Request $request)
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'ward_id' => 'required|exists:wards,id',
        ]);
        if ($validator->fails()) {
            return redirect()->route('profile.address')
                ->withErrors($validator)
                ->withInput();
        }
        $address = new Address();
        $address->ward_id = $request->input('ward_id');
        $address->name = $request->input('name');
        $address->address = $request->input('address');
        $address->phone = $request->input('phone');
        $address->user_id = $user->id;
        $address->save();
        return redirect()->route('profile.address')->with('success', 'Địa chỉ đã được cập nhật.');
    }
    
    public function addressDelete($id)
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        $address = Address::where('user_id', $user->id)->where('id', $id)->first();
        if (!$address) {
            return redirect()->route('profile.address')->with('error', 'Địa chỉ không tồn tại.');
        }
        $address->delete();
        return redirect()->route('profile.address')->with('success', 'Địa chỉ đã được xóa.');
    }
    public function addressDefault($id)
    {
        $user = Session::get('user');
        if (!$user) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        $address = Address::where('user_id', $user->id)->where('id', $id)->first();
        if (!$address) {
            return redirect()->route('profile.address')->with('error', 'Địa chỉ không tồn tại.');
        }
        Address::where('user_id', $user->id)->update(['default' => 0]);
        $address->default = 1;
        $address->save();
        return redirect()->route('profile.address')->with('success', 'Địa chỉ mặc định đã được cập nhật.');
    }
}
