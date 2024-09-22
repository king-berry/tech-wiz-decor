<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $products = Product::with('images')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'qty' => 'required|integer|min:0',
            'categories.*' => 'integer|exists:categories,id',
            'new_category_name' => 'nullable|string|max:255',
            'new_category_type' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'qty' => $request->input('qty')
        ]);
    
        if ($request->has('categories') && is_array($request->input('categories'))) {
            foreach ($request->input('categories') as $categoryId) {
                $product->categories()->attach($categoryId);
            }
        } elseif ($request->input('new_category_name')) {
            $category = new Category();
            $category->name = $request->input('new_category_name');
            $category->type = $request->input('new_category_type');
            $category->save();
    
            $product->categories()->attach($category->id);
        }
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image->store('images/products', 'public')
                ]);
            }
        }
    
        return Redirect::route('admin.products.index')->with('success', 'Sản phẩm được tạo thành công');
    }
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'qty' => 'required|integer|min:0',
            'categories' => 'array',
            'categories.*' => 'integer|exists:categories,id', // Validate danh mục
        ]);
    
        $product->update($request->only(['name', 'price', 'description', 'qty']));
    
        if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        } else {
            $product->categories()->detach();
        }
    
        return Redirect::route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
    
    

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function destroy(Product $product)
    {
        $product->categories()->detach();
        $product->delete();
        return Redirect::route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
