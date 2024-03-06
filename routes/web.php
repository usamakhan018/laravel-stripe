<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(ProductController::class)->group(function() {
    Route::get('', 'index')->name('index');
    Route::match(['get', 'post'], 'product/create', 'create')->name('create');

    Route::get('add_to_cart/{id}', 'add_to_cart')->name('add_to_cart');
    Route::get('cart', 'cart')->name('cart');
    Route::post('cart/remove', 'remove_product')->name('remove_product');
    Route::post('cart/update', 'update_cart')->name('update_cart');

    Route::get('checkout', 'checkout')->name('checkout');

    Route::get('success', function() {
        return response('success your order has been received');
    })->name('success');
    Route::get('cancel', function() {
        return response('error you have canceled your order');
    })->name('cancel');
});
