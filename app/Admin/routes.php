<?php

use Dcat\Admin\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('users', UserController::class);
    $router->resource('products', ProductController::class);
    $router->resource('orders', OrderController::class);
    $router->resource('order-items', OrderitemController::class);
    $router->resource('pages', PageController::class);
    $router->resource('photos', PhotoController::class);
    $router->get('/orders/pdf/{id}', 'OrderController@pdf')->name('orders.pdf');

});
