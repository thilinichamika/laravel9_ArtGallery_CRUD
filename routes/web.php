<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
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

Route::get('/', [productController::class, 'index'])->name('index');
Route::get('/create', [productController::class, 'create'])->name('create');
Route::post('store/', [productController::class, 'store'])->name('store');
Route::get('show/{product}', [productController::class, 'show'])->name('show');
Route::get('edit/{product}', [productController::class, 'edit'])->name('edit');
Route::put('edit/{product}', [productController::class, 'update'])->name('update');
Route::delete('/{product}', [productController::class, 'destroy'])->name('destroy');

Route::get('change-status/{product}', [productController::class, 'changeStatus'])->name('changeStatus');