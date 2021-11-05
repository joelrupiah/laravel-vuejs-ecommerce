<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::prefix('admin')->group(base_path('routes/admin.php'));
Route::prefix('user')->group(base_path('routes/user.php'));

Auth::routes();

Route::get('user-login', 'HomeController@index')->name('login');

Route::get('/', function () {
    return view('user.user_master');
});

// Product Routes
Route::get('product-list', 'ProductController@getAllProduct');
Route::get('product-sidebar', 'ProductController@sidebarInfo');
Route::get('product-category', 'ProductController@maincategoryInfo');
Route::get('product-filter/{data}', 'ProductController@productFilter');

// Cart Routes
Route::group(['prefix' => 'cart'], function() {
    Route::post('add-to-cart', 'CartController@addToCart')->name('addToCart');
    Route::get('cart-product-list', 'CartController@publicList');
    Route::get('remove-product/{id}' ,'CartController@removeProduct')->name('removeProduct');
    Route::post('update-cart', 'CartController@updateCart')->name('updateCart');
});

Route::post('checkout', 'OrderController@checkout')->name('chekout');

Route::get('/{path}', function () {
    return view('user.user_master');
});

Route::get('/{path}/{id}', function () {
    return view('user.user_master');
});

Route::post('/mpesa/stk', 'OrderController@stkPush');
