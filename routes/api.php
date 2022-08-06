<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/products', [HomeController::class, 'products']);
Route::post('/products-search', [HomeController::class, 'products_search']);

Route::get('/product-add-tocart/{id}', [HomeController::class, 'product_addto_cart']);
Route::get('/products-cart', [HomeController::class, 'products_cart']);
Route::get('/product-remove-fromcart/{id}', [HomeController::class, 'product_removefrom_cart']);

Route::get('/product-quantity-increment/{id}', [HomeController::class, 'product_quantity_increment']);
Route::get('/product-quantity-decrement/{id}', [HomeController::class, 'product_quantity_decrement']);

Route::post('/order-submit', [HomeController::class, 'order_submit']);
Route::get('/order-list', [HomeController::class, 'order_list']);
Route::post('/order-search', [HomeController::class, 'order_search']);
Route::get('/order-view/{id}', [HomeController::class, 'order_view']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
