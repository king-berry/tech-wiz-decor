<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('user.products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $reviews = Review::all();
        $relatedProducts = Product::where('id', '!=', $id)->inRandomOrder()->limit(4)->get();

        return view('user.products.show', compact('product' , 'relatedProducts', 'reviews'));
    }
}
