<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->get();
        return view('admin.users.index', compact('users'));
    }

    public function update($id)
    {
        $user = User::withTrashed()->find($id);

        if ($user->trashed()) {
            $user->restore();
        } else {
            $user->delete();
        }

        return redirect()->route('admin.user.index');
    }
}
