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

    Route::post('rate/{id}', 'PageController@rate');
});

Route::get('admin/login', 'App\Http\Controllers\AdminController@login');
Route::post('admin/login', 'App\Http\Controllers\AdminController@checkLogin');
Route::get('admin/register', 'App\Http\Controllers\AdminController@register');
Route::post('admin/register', 'App\Http\Controllers\AdminController@createAccount');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin', 'namespace' => 'App\Http\Controllers',],function(){
    Route::get('/', 'AdminController@dashboard');
    Route::get('logout', 'AdminController@logout');

    /**Account */
    Route::get('account/change', 'AdminController@getFormChange');
    Route::post('account/change', 'AdminController@changePass');
    Route::group(['middleware' => 'accountMng'],function(){
        Route::get('account', 'AdminController@getAcc');
        Route::post('account/update/{id}', 'AdminController@putAcc');
        Route::get('account/delete/{id}', 'AdminController@delAcc');
    });

    /**Product */
    Route::get('product', 'AdminController@getProduct');
    Route::get('product/edit/{id}', 'AdminController@getInforProduct');
    Route::post('product/edit/{id}', 'AdminController@putInforProduct');
    Route::get('product/add', 'AdminController@getFormProduct');
    Route::post('product/add', 'AdminController@addProduct');

    /**Size */
    Route::get('size', 'AdminController@getProductSz');
    Route::post('pro-detail/update/{id}', 'AdminController@putProDetail');
    Route::get('pro-detail/delete/{id}', 'AdminController@delProDetail');
    Route::get('pro-detail/add', 'AdminController@getFormProDetail');
    Route::post('pro-detail/add', 'AdminController@addProDetail');

    /**Sale */
    Route::get('sale', 'AdminController@getSale');
    Route::post('sale/update/{id}', 'AdminController@putSale');
    Route::get('sale/delete/{id}', 'AdminController@delSale');
    Route::get('sale/add', 'AdminController@getFormSale');
    Route::post('sale/add', 'AdminController@addSale');

    /**Rate */
    Route::get('rate', 'AdminController@getRate');
    Route::post('rate/update/{id}', 'AdminController@putRate');
    Route::get('rate/delete/{id}', 'AdminController@delRate');

    /**Brand */
    Route::get('brand', 'AdminController@getBrand');
    Route::get('brand/add', 'AdminController@getFormBrand');
    Route::post('brand/add', 'AdminController@addBrand');
    Route::get('brand/update/{id}', 'AdminController@getInforBrand');
    Route::post('brand/update/{id}', 'AdminController@putBrand');
    Route::get('brand/delete/{id}', 'AdminController@delBrand');

    /**Catalog */
    Route::get('catalog', 'AdminController@getCatalog');
    Route::post('catalog/add', 'AdminController@addCatalog');
    Route::post('catalog/update/{id}', 'AdminController@putCatalog');
    Route::get('catalog/delete/{id}', 'AdminController@delCatalog');

    /**Payment */
    Route::get('payment', 'AdminController@getPayment');
    Route::post('payment/add', 'AdminController@addPayment');
    Route::post('payment/update/{id}', 'AdminController@putPayment');
    Route::get('payment/delete/{id}', 'AdminController@delPayment');

    /**Order */
    Route::get('order', 'AdminController@getOrder');
    Route::get('order/detail/{id}', 'AdminController@getDetail');
    Route::post('order/update/{id}', 'AdminController@putOrder');
    Route::get('order/delete/{id}', 'AdminController@delOrder');

    /**Customer */
    Route::get('customer','AdminController@getCustomer');
});