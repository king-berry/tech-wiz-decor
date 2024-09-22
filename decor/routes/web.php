<?php

use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\ConfigController;
use App\Http\Controllers\AdminController\ProductController as AdminProductController;
use App\Http\Controllers\UserController\ProductController as UserProductController;
use App\Http\Controllers\UserController\UserController as UserUserController;
use App\Http\Controllers\AdminController\UserController as AdminUserController;
use App\Http\Controllers\AdminController\VoucherController as AdminVoucherController;
use App\Http\Controllers\UserController\VoucherController as UserVoucherController;
use App\Http\Controllers\AdminController\OrderController as AdminOrderController;
use App\Http\Controllers\UserController\ReviewController as UserReviewController;
use App\Http\Controllers\AdminController\ReviewController as AdminReviewController;
use App\Http\Controllers\UserController\OrderController as UserOrderController;
use App\Http\Controllers\UserController\CartController;
use App\Http\Controllers\UserController\OrderController;
use App\Http\Controllers\UserController\ProfileController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Account
Route::get('home', [UserUserController::class, 'index'])->name('user.home.index');
Route::get('register', [UserUserController::class, 'register'])->name('account.register');
Route::post('register', [UserUserController::class, 'postRegister'])->name('account.postRegister');
Route::get('login', [UserUserController::class, 'login'])->name('account.login');
Route::post('login', [UserUserController::class, 'postLogin'])->name('account.postLogin');
Route::get('logout', [UserUserController::class, 'logout'])->name('account.logout');
//Profile-User
Route::get('/user/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/user/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/user/profile/address', [ProfileController::class, 'address'])->name('profile.address');
Route::get('/user/profile/address/{id}', [ProfileController::class, 'addressEdit'])->name('address.edit');
Route::post('/user/profile/address', [ProfileController::class, 'addressUpdate'])->name('address.updateAddress');
Route::put('/user/profile/address/default/{id}', [ProfileController::class, 'addressDefault'])->name('address.default');     
Route::delete('/user/profile/address/{id}', [ProfileController::class, 'addressDelete'])->name('address.destroy');

//User-products
Route::get('/user/products', [UserProductController::class, 'index'])->name('user.products.index');
Route::get('/user/products/{id}', [UserProductController::class, 'show'])->name('products.show');

//User-cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/checkout', [CartController::class, 'Checkout'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'placeOrder'])->name('cart.placeOrder');

Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');


Route::get('/user/districts/{province_id}', [CartController::class, 'getDistricts'])->name('districts.get');
Route::get('/user/wards/{districts_id}', [CartController::class, 'getWards'])->name('wards.get');
//User-voucher
Route::get('/user/check-voucher/{code}', [UserVoucherController::class, 'checkVoucher']);

//User-orders
Route::get('/user/orders', [OrderController::class, 'index'])->name('order.index');
Route::get('/user/orders/{order}', [OrderController::class, 'show'])->name('order.show');
Route::delete('/user/orders/destroy/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
Route::post('/user/order/{code}/confirm-receipt', [OrderController::class, 'confirmReceipt'])->name('order.confirmReceipt');

//User-reviews
Route::post('/user/reviews', [UserReviewController::class, 'store'])->name('review.store');















//Admin-dashboard
Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
Route::get('/adminlogin', [AdminController::class, 'login'])->name('admin.login');
Route::post('/adminlogin', [AdminController::class, 'postLogin'])->name('admin.postLogin');
Route::get('/', [AdminController::class, 'logout'])->name('admin.logout');
//Admun-Users
Route::get('admin/users', [AdminUserController::class, 'index'])->name('admin.user.index');
Route::get('admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');

//Admin-categories
Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
//Admin-products
Route::get('admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
Route::get('admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
Route::post('admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
Route::get('admin/products/{product}', [AdminProductController::class, 'show'])->name('admin.products.show');
Route::get('admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
Route::put('admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
Route::delete('admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
//Admin-vouchers
Route::get('admin/vouchers', [AdminVoucherController::class, 'index'])->name('admin.vouchers.index');
Route::get('admin/vouchers/create', [AdminVoucherController::class, 'create'])->name('admin.vouchers.create');
Route::post('admin/vouchers', [AdminVoucherController::class, 'store'])->name('admin.vouchers.store');
Route::get('admin/vouchers/{voucher}/edit', [AdminVoucherController::class, 'edit'])->name('admin.vouchers.edit');
Route::put('admin/vouchers/{voucher}', [AdminVoucherController::class, 'update'])->name('admin.vouchers.update');
Route::delete('admin/vouchers/{voucher}', [AdminVoucherController::class, 'destroy'])->name('admin.vouchers.destroy');
//Admin-orders
Route::get('admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
Route::get('admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
Route::put('admin/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');
Route::delete('admin/orders/{order}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
//Admin-reviews
Route::get('admin/reviews', [AdminReviewController::class, 'index'])->name('admin.reviews.index');
Route::delete('admin/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
//Admin-config
Route::get('admin/configs/edit-background-color', [ConfigController::class, 'editBackgroundColor'])->name('admin.configs.editBackgroundColor');
Route::put('admin/configs/update-background-color', [ConfigController::class, 'updateBackgroundColor'])->name('admin.configs.updateBackgroundColor');