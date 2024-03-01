<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminTransaksiDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
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
    Route::get('/admin/dashboard', [AdminUserController::class, 'indexDashboard'])->name('admin.dashboard.index');

    Route::middleware('checkRole:admin')->group(function () {
        Route::resource('/admin/user', AdminUserController::class);
        Route::resource('/admin/produk', AdminProdukController::class);
        Route::resource('/admin/kategori', AdminKategoriController::class);
    });

    Route::middleware('checkRole:petugas')->group(function () {
        Route::resource('/produk', AdminProdukController::class);
        Route::resource('/kategori', AdminKategoriController::class);
        Route::get('/transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi.monit');
        Route::get('/transaksi/create', [AdminTransaksiController::class, 'create'])->name('transaksi.create');
        Route::post('/transaksi/store', [AdminTransaksiController::class, 'store'])->name('transaksi.store');
        Route::post('/transaksi/detail/store', [AdminTransaksiDetailController::class, 'store'])->name('detailtransaksi.store');
        Route::get('/transaksi/detail/delete', [AdminTransaksiDetailController::class, 'delete']);
        Route::get('/transaksi/cetak', [AdminTransaksiDetailController::class, 'cetakStruk'])->name('cetakStruk');
        Route::resource('/pelanggan', PelangganController::class);
        Route::get('/transaksi/pelanggan', [AdminTransaksiDetailController::class, 'pendingTransaksi'])->name('detailtransaksi.pending');
    });
    Route::get('/laporan', [AdminTransaksiController::class, 'laporanPenjualan']);
    Route::get('/cetaklaporan', [AdminTransaksiController::class, 'generateLaporan']);
});
