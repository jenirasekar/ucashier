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

Route::get('/template', function () {
    return view('template');
});

Route::resource('/user', AdminUserController::class);

Route::get('/post', function () {
    $data = [
        'content' => 'admin.post.index',
    ];

    return view('admin.layouts.wrapper', $data);
});
