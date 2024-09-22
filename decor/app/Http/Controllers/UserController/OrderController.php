<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = session()->get('user');
        $userAddressIds = $user->address->pluck('id');
        $orders = Order::whereIn('address_id', $userAddressIds)->get();

        $status = $request->input('status');
        if ($status) {
            $orders = Order::whereIn('address_id', $userAddressIds)
                ->where('status', $status)
                ->orderBy('created_at', 'asc')
                ->get();
        }
        return view('user.order.index', compact('orders'));
    }

    public function show($code)
    {
        $user = session()->get('user');
        $userAddressIds = $user->address->pluck('id');

        $order = Order::whereIn('address_id', $userAddressIds)
            ->where('code', $code)
            ->firstOrFail();

        return view('user.order.show', compact('order'));
    }

    public function destroy($code)
    {
        $user = session()->get('user');
        $userAddressIds = $user->address->pluck('id');

        $order = Order::whereIn('address_id', $userAddressIds)
            ->where('code', $code)
            ->firstOrFail();

        if ($order->status == 2) {
            return redirect()->route('order.show', ['order' => $code])->with('error', 'Không thể xóa đơn hàng đã hoàn thành');
        }

        $order->status = 4;
        $order->save();

        return redirect()->route('order.show', ['order' => $code])->with('success', 'Xóa đơn hàng thành công');
    }
    public function confirmReceipt($code)
    {
        $user = session()->get('user');
        $userAddressIds = $user->address->pluck('id');

        $order = Order::whereIn('address_id', $userAddressIds)
            ->where('code', $code)
            ->firstOrFail();

        if ($order->status == 3) {
            $order->status = 5;
            $order->save();

            return redirect()->route('order.show', ['order' => $code])->with('success', 'Xác nhận đã nhận hàng thành công.');
        }

        return redirect()->route('order.show', ['order' => $code])->with('error', 'Không thể xác nhận đơn hàng này.');
    }
}
