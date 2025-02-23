<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BuynowController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::get('/aboutpage', [PagesController::class, 'about'])->name('aboutpage');
// Add this line to define the contact page route
Route::get('/whyKiddoBazzar', [PagesController::class, 'whyKiddoBazzar'])->name('whyKiddoBazzar');
// term and condition
Route::get('/termandcondition', [PagesController::class, 'termandcondition'])->name('termandcondition');


Route::get('/viewproduct/{id}', [PagesController::class, 'viewproduct'])->name('viewproduct');
Route::get('/categoryproduct/{id}', [PagesController::class, 'categoryproduct'])->name('categoryproduct');
Route::get('/search', [PagesController::class, 'search'])->name('search');



Route::middleware('auth')->group(function () {
    Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('mycart', [CartController::class, 'mycart'])->name('mycart');
    Route::get('cart/{id}/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('checkout/{cartid}', [PagesController::class, 'checkout'])->name('checkout');
    Route::get('order/{cartid}/store', [OrderController::class, 'store'])->name('order.store');
    Route::post('order/store', [OrderController::class, 'storecod'])->name('order.storecod');
    Route::get('myorder', [OrderController::class, 'myorder'])->name('myorder');
    Route::delete('order/destroy', [OrderController::class, 'destroy'])->name('order.destroy');

    // update product stock after order
    Route::get('order/{id}/update', [OrderController::class, 'update'])->name('order.update');

    //Order history
    Route::get('cancelhistory', [OrderController::class, 'orderhistory'])->name('cancelhistory');
    //delete order history
    Route::delete('cancelhistory/destroy', [OrderController::class, 'orderhistorydestroy'])->name('cancelhistory.destroy');

    //buynow
    Route::post('/buy-now/{product}', [BuynowController::class, 'buyNow'])->name('buynow.buy');
    Route::get('/checkout', [BuynowController::class, 'checkout'])->name('buynow.checkout');
    Route::post('/place-order', [BuynowController::class, 'placeOrder'])->name('buynow.placeOrder');
    Route::get('/store/{productid}/{qty}', [BuynowController::class, 'store'])->name('buynow.store'); // Adjust to POST







    //review
    Route::post('viewproduct/{id}/review', [ReviewController::class, 'store'])->name('review.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    //Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    // Route::get('category/{id}', [CategoryController::class, 'showCategoryProducts'])->name('categoryproduct'); //for banner link

    //Product
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');

    //Banner
    Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
    Route::get('/banner/create', [BannerController::class, 'create'])->name('banner.create');
    Route::post('/banner/store', [BannerController::class, 'store'])->name('banner.store');
    Route::get('/banner/{id}/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::post('/banner/{id}/update', [BannerController::class, 'update'])->name('banner.update');
    Route::delete('/banner/{id}/destroy', [BannerController::class, 'destroy'])->name('banner.destroy');


    //Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{id}/status/{status}', [OrderController::class, 'status'])->name('order.status');

    //user
    Route::get('/userindex', [UserController::class, 'userindex'])->name('user.index');

    //report
    Route::get('/report', [DashboardController::class, 'report'])->name('report');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
