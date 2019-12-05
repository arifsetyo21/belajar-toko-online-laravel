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

Route::post('cart', 'CartController@addProduct')->name('cart');
Route::resource('categories', 'CategoryController');
Route::resource('products', 'ProductController');
Route::resource('catalogs', 'CatalogsController');
Route::get('/home', 'HomeController@index')->name('home');
