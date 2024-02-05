<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminTransaksiDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StrukController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/login', [AdminAuthController::class, 'index'])->name('login');
    Route::post('/login/do', [AdminAuthController::class, 'doLogin'])->name('loginDo');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminUserController::class, 'indexDashboard'])->name('admin.dashboard.index');

    Route::middleware('checkRole:admin')->group(function () {
        Route::resource('/admin/user', AdminUserController::class);
    });

    Route::middleware('checkRole:petugas')->group(function () {
        Route::resource('/kategori', AdminKategoriController::class);
        Route::resource('/produk', AdminProdukController::class);
        Route::resource('/transaksi', AdminTransaksiController::class);
        Route::post('/transaksi/detail/create', [AdminTransaksiDetailController::class, 'create']);
        Route::get('/transaksi/detail/delete', [AdminTransaksiDetailController::class, 'delete']);
        Route::get('/transaksi/detail/selesai/{id}', [AdminTransaksiDetailController::class, 'done'])->name('done');
        Route::post('/transaksi/pembayaran/{id}', [AdminTransaksiDetailController::class, 'pembayaran'])->name('pembayaran');
        Route::resource('/pelanggan', PelangganController::class);
    });
});

Route::get('/struk', function () {
    return view('transaksi.struk');
});
