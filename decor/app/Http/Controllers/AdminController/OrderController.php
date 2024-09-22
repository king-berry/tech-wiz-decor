<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderByRaw("status = 3 ASC") // Đưa các đơn đã giao (status = 3) xuống cuối
                       ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian tạo mới nhất ở trên
                       ->get();
    
        return view('admin.orders.index', compact('orders'));
    }
    
   public function show($id)
   {
       $order = Order::with('address.ward.district.province', 'address.user', 'orderDetails.product')->findOrFail($id);
       return view('admin.orders.show', compact('order'));
   }
   
   public function update( $id)
   {
       $order = Order::findOrFail($id);
   
       if ($order->status < 3) {
           $order->status += 1;
           $order->save();
       }
   
       return redirect()->route('admin.orders.show', $id)->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
   }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back();
    }
}
