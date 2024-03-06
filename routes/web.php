<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('sales.index');
})->name('home');
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('sales', SaleController::class);
Route::delete('sales/{product}/{sale}/removeItem', [SaleController::class, 'removeItem'])->name('sales.removeItem');
Route::post('sales/{sale}/{status}/changeStatus', [SaleController::class, 'changeStatus'])->name('sales.changeStatus');
