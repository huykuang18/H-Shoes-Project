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

Route::get('/','App\Http\Controllers\PageController@getIndex');

Route::get('shop/{type?}/{id?}','App\Http\Controllers\PageController@search');
Route::get('product/{id}','App\Http\Controllers\PageController@productDetail');

Route::get('cart/{action?}/{id?}','App\Http\Controllers\CartController@cart');
Route::post('cart/{action?}/{id?}','App\Http\Controllers\CartController@cart');

Route::get('wish/{action?}/{id?}','App\Http\Controllers\WishListController@wish');
Route::post('wish/{action?}/{id?}','App\Http\Controllers\WishListController@wish');

Route::get('checkout','App\Http\Controllers\PageController@checkout');
Route::post('checkout','App\Http\Controllers\PageController@order');

Route::get('checkorder/{type?}','App\Http\Controllers\PageController@getSearch');
Route::get('checkorder/detail/{id}','App\Http\Controllers\PageController@orderDetail');
Route::get('checkorder/delete/{id}','App\Http\Controllers\PageController@deleteOrder');

Route::post('rate/{id}','App\Http\Controllers\PageController@rate');