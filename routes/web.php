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

Route::get('prepaid-balance', function () {
    return view('prepaid_balances.form');
})->name('prepaid-balance.create');

Route::post('prepaid-balance', function () {
    dd(1);
})->name('prepaid-balance.store');
