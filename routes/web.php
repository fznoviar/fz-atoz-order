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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('prepaid-balances', 'PrepaidBalanceController@create')
    ->name('prepaid-balances.create');
Route::get('prepaid-balances/{prepaid_balance}', 'PrepaidBalanceController@show')
    ->name('prepaid-balances.show');
Route::post('prepaid-balances', 'PrepaidBalanceController@store')
    ->name('prepaid-balances.store');
Route::get('product-commerces', 'ProductCommerceController@create')
    ->name('product-commerces.create');
Route::get('product-commerces/{product_commerce}', 'ProductCommerceController@show')
    ->name('product-commerces.show');
Route::post('product-commerces', 'ProductCommerceController@store')
    ->name('product-commerces.store');

Route::get('order', 'OrderController@index')
    ->name('orders.index');
Route::get('payment', 'PaymentController@index')
    ->name('payments.index');
Route::post('payment', 'PaymentController@store')
    ->name('payments.store');
