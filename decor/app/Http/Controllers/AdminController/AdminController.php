<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {   
        if(!session()->has('admin')){
            return redirect()->route('admin.login');
        }
        return view('admin.dashboad.index');
    }
    public function login(){

        return view('admin.auth.login');
    }
    
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $request->input('email'))->first();

        if ($admin && Hash::check($request->input('password'), $admin->password)) {
            session()->put('admin', $admin);

            return redirect()->route('admin.index');
        } else {
            return back()->withErrors([
                'email' => 'Thông tin xác thực được cung cấp không khớp.',
            ]);
        }
    }
    public function logout()
    {
        session()->forget('admin'); 

        return view('welcome');
    }


}
