<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rate' => 'required',
            'text' => 'required',
        ]);

        $orderDetail = OrderDetail::findOrFail($request->order_detail_id);

        $review = new Review();
        $review->order_detail_id = $orderDetail->id;
        $review->rate = $request->rate;
        $review->text = $request->text;
        $review->save();

        return redirect()->route('products.show', ['id' => $orderDetail->product_id])->with('success', 'Đánh giá sản phẩm thành công');
    }

}
