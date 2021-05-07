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

Route::group(['namespace' => 'App\Http\Controllers',], function () {
    Route::get('/', 'PageController@getIndex');

    Route::get('contact', 'PageController@contact');
    Route::post('message/send','PageController@addFeedback');

    Route::get('shop/{type?}/{id?}', 'PageController@search');
    Route::get('product/{id}', 'PageController@productDetail');

    Route::get('cart/{action?}/{id?}', 'CartController@cart');
    Route::post('cart/{action?}/{id?}', 'CartController@cart');

    Route::get('wish/{action?}/{id?}', 'WishListController@wish');
    Route::post('wish/{action?}/{id?}', 'WishListController@wish');

    Route::get('checkout', 'PageController@checkout');
    Route::post('checkout', 'PageController@order');

    Route::get('checkorder/{type?}', 'PageController@getSearch');
    Route::get('checkorder/detail/{id}', 'PageController@orderDetail');
    Route::get('checkorder/delete/{id}', 'PageController@deleteOrder');

    Route::post('rate/{id}', 'PageController@rate');
});

Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers',],function(){
    
});