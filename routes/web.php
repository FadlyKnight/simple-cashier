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

Route::get('transaction', 'TransactionController@index')->name('transaction.index');
Route::get('food', 'ProductController@index')->name('product.index');
Route::view('food/create', 'content.product.create')->name('product.create');
Route::post('food/create', 'ProductController@create')->name('product.create.post');