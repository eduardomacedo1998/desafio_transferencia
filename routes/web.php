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

Route::resource('products', App\Http\Controllers\ProductWebController::class);
Route::resource('warehouses', App\Http\Controllers\WarehouseWebController::class);
Route::resource('inventories', App\Http\Controllers\InventoryWebController::class);
Route::resource('transfers', App\Http\Controllers\TransferWebController::class);
Route::resource('users', App\Http\Controllers\UserWebController::class);
Route::post('/inventory/transfer', [App\Http\Controllers\TransferController::class, 'transfer']);
