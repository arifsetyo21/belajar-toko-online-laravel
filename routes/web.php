<?php

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
    // return view('welcome');
    return redirect()->route('catalogs.index');
});

Auth::routes();

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::post('/', 'CartController@addProduct')->name('cart.addProduct');
    Route::delete('/{product_id}', 'CartController@removeProduct')->name('cart.removeProduct');
    Route::put('/{product_id}', 'CartController@updateProduct')->name('cart.updateProduct');
});

Route::group(['prefix' => 'checkout'], function () {
    Route::get('/login', 'CheckoutController@login')->name('chekcout.login');
    Route::post('/login', 'CheckoutController@postLogin')->name('checkout.postLogin');
    // Route::get('/checkout/address', function() {
    //     return "Email customer " . session()->get('checkout.email');
    // })->name('checkout.address');
    Route::get('/address', 'CheckoutController@address')->name('checkout.address');
    Route::post('/address', 'CheckoutController@postAddress');
    Route::get('payment', 'CheckoutController@payment');
    Route::post('payment', 'CheckoutController@postPayment');
    Route::get('success', 'CheckoutController@success');
});

Route::get('/home/orders', 'HomeController@viewOrders');

Route::resource('orders', 'OrderController', ['only' => ['index', 'edit', 'update']]);
Route::resource('categories', 'CategoryController');
Route::resource('products', 'ProductController');
Route::resource('catalogs', 'CatalogsController');
Route::get('/home', 'HomeController@index')->name('home');
