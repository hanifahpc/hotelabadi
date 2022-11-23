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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('user',[userController::class,'index'])->middleware(['role:admin,staff'])->name('user.index');
Route::get('user/create',[userController::class,'create'])->middleware(['role:admin,staff'])->name('user.create');
Route::post('user/store',[userController::class,'store'])->middleware(['role:admin,staff'])->name('user.store');
Route::get('user/edit/{id}',[userController::class,'edit'])->middleware(['role:admin,staff'])->name('user.edit');
Route::put('user/{id}',[userController::class,'update'])->middleware(['role:admin,staff'])->name('user.update');
Route::get('user/show/{id}',[userController::class,'show'])->middleware(['role:admin,staff'])->name('user.show');
Route::delete('user/{id}',[userController::class,'destroy'])->middleware(['role:admin,staff'])->name('user.delete');

Route::get('kategori',[kategoriController::class,'index'])->middleware(['role:admin,staff'])->name('kategori.index');
Route::get('kategori/create',[kategoriController::class,'create'])->middleware(['role:admin,staff'])->name('kategori.create');
Route::post('kategori/store',[kategoriController::class,'store'])->middleware(['role:admin,staff'])->name('kategori.store');
Route::get('kategori/edit/{id}',[kategoriController::class,'edit'])->middleware(['role:admin,staff'])->name('kategori.edit');
Route::put('kategori/{id}',[kategoriController::class,'update'])->middleware(['role:admin,staff'])->name('kategori.update');
Route::get('kategori/show/{id}',[kategoriController::class,'show'])->middleware(['role:admin,staff'])->name('kategori.show');
Route::delete('kategori/{id}',[kategoriController::class,'destroy'])->middleware(['role:admin,staff'])->name('kategori.delete');

Route::get('buku',[bukuController::class,'index'])->middleware(['role:admin,staff'])->name('buku.index');
Route::get('buku/create',[bukuController::class,'create'])->middleware(['role:admin,staff'])->name('buku.create');
Route::post('buku/store',[bukuController::class,'store'])->middleware(['role:admin,staff'])->name('buku.store');
Route::get('buku/edit/{id}',[bukuController::class,'edit'])->middleware(['role:admin,staff'])->name('buku.edit');
Route::put('buku/{id}',[bukuController::class,'update'])->middleware(['role:admin,staff'])->name('buku.update');
Route::get('buku/show/{id}',[bukuController::class,'show'])->middleware(['role:admin,staff'])->name('buku.show');
Route::delete('buku/{id}',[bukuController::class,'destroy'])->middleware(['role:admin,staff'])->name('buku.delete');
Route::get('buku/hapus/{id}',[bukucontroller::class,'hapus'])->middleware(['role:admmin,staff'])->name('buku,hapus');

