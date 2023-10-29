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

Route::get('/admin/user', 'AdminUserController@index')->name('admin.user.index');

Route::get('/', function () {
    $data = [
        'content' => 'admin.dashboard.index',
    ];

    return view('admin.layouts.wrapper', $data);
});


// Route::prefix('/admin')->group(function () {
//     Route::resource('/user', AdminUserController::class);
// });

Route::get('/admin/user/{id}/edit', 'AdminUserController@edit')->name('admin.user.edit');
Route::put('/admin/user/{id}', 'AdminUserController@update')->name('admin.user.update');

