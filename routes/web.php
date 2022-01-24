<?php

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

Auth::routes();

Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return \Redirect::to('/');
})->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/store-product', [App\Http\Controllers\ProductController::class, 'addproduct'])->name('store-product');

Route::get('/store-products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('store-products');
Route::post('/updateProduct/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct');

Route::post('/store-product-add', [App\Http\Controllers\ProductController::class, 'store'])->name('store-product-add');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products');

Route::get('/deleteProduct/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteProduct');


Route::get('/pos', [App\Http\Controllers\OrderController::class, 'index'])->name('pos');
Route::post('/pos', [App\Http\Controllers\OrderController::class, 'store'])->name('pos');
Route::get('/add-to-cart/{id}', [App\Http\Controllers\OrderController::class, 'addToCart'])->name('add-to-cart');
Route::post('/orderDone', [App\Http\Controllers\OrderController::class, 'order'])->name('orderDone');
Route::get('/add-to-cart-delete/{id}', [App\Http\Controllers\OrderController::class, 'cartDelete'])->name('add-to-cart-delete');

Route::get('/today-orders', [App\Http\Controllers\OrderController::class, 'todayOrder'])->name('today-orders');

Route::get('/update-order-status/{id}/{status}', [App\Http\Controllers\OrderController::class, 'updateOrderStatus'])->name('update-order-status');
Route::get('/delete-order/{id}', [App\Http\Controllers\OrderController::class, 'deleteOrder'])->name('update-order');

Route::get('/order-details/{id}', [App\Http\Controllers\OrderController::class, 'orderDetails'])->name('order-details');

Route::get('/stock', [App\Http\Controllers\ProductController::class, 'productStock'])->name('stock');

Route::get('/AddVendorForm', [App\Http\Controllers\VendorInformationController::class, 'AddVendorProfile'])->name('AddVendorForm');
Route::post('/AddVendorForm', [App\Http\Controllers\VendorInformationController::class, 'SaveVendor'])->name('save.vendor');

Route::get('/ViewVendorForm', [App\Http\Controllers\VendorInformationController::class, 'ViewVendorProfile'])->name('ViewVendorForm');
//Route::get('/ListVendorForm', [App\Http\Controllers\VendorInformationController::class, 'ListVendorDetails'])->name('UpdateVendorForm');
Route::get('/UpdateVendorForm/{id}', [App\Http\Controllers\VendorInformationController::class, 'UpdateVendorProfile'])->name('UpdateVendorForm');

Route::get('/DeleteVendorProfile/{id}', [App\Http\Controllers\VendorInformationController::class, 'DeleteVendorProfile'])->name('DeleteVendorProfile');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

