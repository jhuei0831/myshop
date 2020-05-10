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
use App\User;

use Illuminate\Support\Facades\Input;

Route::pattern('id', '[0-9]+');
Route::pattern('id', '[0-9]+');

Route::get('/', 'ProductController@index')->name('index');
// Route::get ( '/', function () {
//     return view ( 'welcome' );
// } );
// Route::any ( '/product/search', function () {
//     $search = Input::get( 'search' );
//     $user = User::where( 'name', 'LIKE', '%' . $search . '%' )->orWhere( 'email', 'LIKE', '%' . $search . '%' )->get();
//     if (count( $user ) > 0)
//         return view( 'welcome' )->withDetails( $user )->withQuery( $search );
//     else
//         return view( 'welcome' )->withMessage( 'No Details found. Try to search again !' );
// } );

Route::get('/product', 'ProductController@index')->name('product.index');
Route::get('/product/table', 'ProductController@table')->name('product.table');
Route::get('/product/{id}', 'ProductController@show')->name('product.show');
Route::get('/product/{product}', 'ProductController@show')->name('product.show');
Route::any('/product/image/search', 'ProductController@search');
Route::any('/product/table/search', 'ProductController@search_table');


Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/store', 'CartController@store')->name('cart.store');
Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');

Route::post('/order/store', 'OrderController@store')->name('order.store');
Route::get('/order', 'OrderController@index')->name('order.index');

Route::get('/pages/{name}', 'PageController@pages')->name('pages');

// Route::get('/layouts/header', 'PhotoController@index')->name('layouts.header');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
