<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminUserController;
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
});

/* Delete user */
Route::delete('/admin/user/{id}/delete', [AdminUserController::class, 'destroy'])->name('admin.user.delete');
