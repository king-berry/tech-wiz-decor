<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home.index');
    }
    public function register()
    {
        return view('user.auth.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'user',
        ]);

        session()->put('user', $user);

        return redirect()->route('user.home.index');
    }

    public function login()
    {
        return view('user.auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            session()->put('user', $user);

            return redirect()->route('user.home.index');
        } else {
            return back()->withErrors([
                'email' => 'Thông tin xác thực được cung cấp không khớp.',
            ]);
        }
    }

    public function logout()
    {
        session()->forget('user'); 

        return redirect()->route('account.login');
    }
}
