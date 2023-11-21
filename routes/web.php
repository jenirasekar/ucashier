<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DetailTransaksiController;
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
    return view('admin.layouts.wrapper', ['content' => 'index']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AdminAuthController::class, 'index'])->name('login');
    Route::post('/login/do', [AdminAuthController::class, 'doLogin'])->name('doLogin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    
    /* 
    * Dashboard
    */
    Route::get('/admin/dashboard', [AdminUserController::class, 'indexDashboard'])->name('admin.dashboard.index');

    /* 
    * User
    */
    Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/user/create', [AdminUserController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/user/store', [AdminUserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/user/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/admin/user/{id}/update', [AdminUserController::class, 'update'])->name('admin.user.update');

    /* 
    * Kategori
    */
    Route::get('/admin/kategori', [AdminKategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/admin/kategori/create', [AdminKategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('/admin/kategori/store', [AdminKategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/admin/kategori/{id}/edit', [AdminKategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/admin/kategori/{id}/update', [AdminKategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/{id}/delete', [AdminKategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    /* 
    * Produk 
    */
    Route::get('/admin/produk', [AdminProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('/admin/produk/create', [AdminProdukController::class, 'create'])->name('admin.produk.create');
    Route::post('/admin/produk/store', [AdminProdukController::class, 'store'])->name('admin.produk.store');
    Route::get('/admin/produk/{id}/edit', [AdminProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('/admin/produk/{id}/update', [AdminProdukController::class, 'update'])->name('admin.produk.update');
    Route::delete('/admin/produk/{id}/delete', [AdminProdukController::class, 'destroy'])->name('admin.produk.destroy');

    /* 
    * Transaksi 
    */
    Route::get('/admin/transaksi', [AdminTransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/admin/transaksi/create', [AdminTransaksiController::class, 'create'])->name('admin.transaksi.create');
    Route::post('/admin/transaksi/store', [AdminTransaksiController::class, 'store'])->name('admin.transaksi.store');
    Route::get('/admin/transaksi/{id}/edit', [AdminTransaksiController::class, 'edit'])->name('admin.transaksi.edit');
    Route::put('/admin/transaksi/{id}/update', [AdminTransaksiController::class, 'update'])->name('admin.transaksi.update');
    Route::delete('/admin/transaksi/{id}/delete', [AdminTransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');

    /* 
    * Detail Transaksi
    */
    Route::post('/admin/detail-transaksi/store', [DetailTransaksiController::class, 'store'])->name('detailtransaksi.store');
});

/* Delete user */
Route::delete('/admin/user/{id}/delete', [AdminUserController::class, 'destroy'])->name('admin.user.delete');
