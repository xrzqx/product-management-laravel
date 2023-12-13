<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
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

Route::get('/', [HomeController::class, 'index'])->name('produk.index');
Route::get('/search', [HomeController::class, 'search'])->name('produk.search');
Route::get('/{id}', [HomeController::class, 'edit'])->name('produk.edit');
Route::put('/{id}', [HomeController::class, 'update'])->name('produk.update');
Route::delete('/{id}', [HomeController::class, 'destroy'])->name('produk.destroy');

Route::resource('produk', HomeController::class)->only([
    'store'
]);

Route::resource('kategori', KategoriController::class)->only([
    'store'
]);