<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:vouchers,code',
            'ratio' => 'required|numeric|between:0,99.99',
            'description' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
        ]);

        Voucher::create($request->all());

        return redirect()->route('admin.vouchers.index')
                         ->with('success', 'Voucher created successfully.');
    }

    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:vouchers,code,' . $id,
            'ratio' => 'required|numeric|between:0,99.99',
            'description' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
        ]);

        $voucher = Voucher::findOrFail($id);
        $voucher->update($request->all());

        return redirect()->route('admin.vouchers.index')
                         ->with('success', 'Voucher updated successfully.');
    }

    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();

        return redirect()->route('admin.vouchers.index')
                         ->with('success', 'Voucher deleted successfully.');
    }
}
