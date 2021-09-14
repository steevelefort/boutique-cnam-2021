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

Route::get('/', 'ProductController@index');
Route::get('/product/view/{id}', 'ProductController@showProduct');
Route::get('/add-to-cart/{id}', 'ProductController@addToCart');
Route::get('/cart','ProductController@viewCart');

Route::get('/product/create', 'ProductController@createProduct');
Route::post('/product/create', 'ProductController@saveProduct');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
