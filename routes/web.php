<?php

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
    $data = [
        'content' => 'admin.dashboard.index',
    ];

    return view('admin.layouts.wrapper', $data);
});

Route::prefix('/admin')->group(function () {
    Route::resource('/user', AdminUserController::class);
});

Route::put('/admin/user/', function () {
    $data = [
        'content' => 'admin.user.index',
    ];
    return view('admin.layouts.wrapper', $data);
});
