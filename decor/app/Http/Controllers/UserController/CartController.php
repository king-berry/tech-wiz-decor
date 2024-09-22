<?php

namespace App\Http\Controllers\UserController;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Voucher;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.cart.index', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('productId');
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $product = Product::find($productId);
            $cart[$productId] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->images->first()->image,
                "quantity" => 1,
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json(['cartCount' => array_sum(array_column($cart, 'quantity'))]);
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (!session()->has('user')) {
            return redirect()->route('account.login')->with('error', 'Bạn cần đăng nhập để thực hiện thanh toán.');
        }
        $user = session()->get('user');
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        $savedAddresses =  Address::where('user_id', $user->id)->get();
        return view('user.cart.checkout', compact('cart', 'user', 'provinces', 'districts', 'wards','savedAddresses'));
    }
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        
        // Validate voucher code if provided
        $validator = Validator::make($request->all(), [
            'address_id' => 'required|exists:addresses,id',
            'voucher_code' => 'nullable|string|exists:vouchers,code',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('cart.checkout')
                ->withErrors($validator)
                ->withInput();
        }
    
        // Calculate total price
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    
        // Create a new order
        $order = new Order();
        $order->address_id = $request->input('address_id');
        $order->price = $total;
        $order->status = 1;
        $order->code = Str::random(5);
        $voucher = Voucher::where('code', $request->input('voucher_code'))->first();
        if ($voucher) {
            $discount = $total * ($voucher->ratio / 100);
            $total -= $discount;
            $order->voucher_id = $voucher->id;
            $voucher->qty = max(0, $voucher->qty - 1); // Ensure qty does not go negative
            $voucher->save();
        }
        $order->price = $total; // Update the order total with the discounted price
        $order->save();
    
        // Save order details
        foreach ($cart as $productId => $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $productId;
            $orderDetail->qty = $item['quantity'];
            $orderDetail->price = $item['price'];
            $orderDetail->save();
        }
    
        // Clear the cart
        session()->forget('cart');
    
        return view('components.user.thank')->with('success', 'Đặt hàng thành công!');
    }
    
    

    public function getDistricts($province_id)
    {
        $districts = District::where('province_id', $province_id)->get();
        return response()->json($districts);
    }

    public function getWards($district_id)
    {
        $wards = Ward::where('district_id', $district_id)->get();
        return response()->json($wards);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->input('quantity') as $id => $quantity) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('user.cart.index')->with('success', 'Giỏ hàng đã được cập nhật thành công!');
    }
public function applyCoupon(Request $request)
{
    $voucherCode = $request->input('voucher_code');
    $voucher = Voucher::where('code', $voucherCode)->first();

    if ($voucher) {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $discount = $total * ($voucher->ratio / 100);
        $newTotal = $total - $discount;

        return response()->json([
            'success' => true,
            'new_total' => $newTotal,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Mã giảm giá không hợp lệ.',
        ]);
    }
}

}
