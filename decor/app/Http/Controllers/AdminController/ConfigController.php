<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function editBackgroundColor()
    {
        $color = Config::where('key', 'hero_background_color')->first();
        return view('admin.configs.edit', ['color' => $color]);
    }

    public function updateBackgroundColor(Request $request)
    {
        $request->validate([
            'color' => 'required|string|max:7', 
        ]);

        Config::updateOrCreate(
            ['key' => 'hero_background_color'],
            ['value' => $request->input('color')]
        );

        return redirect()->back()->with('success', 'Màu sắc được cập nhật thành công!');
    }
}
