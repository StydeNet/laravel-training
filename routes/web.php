<?php

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

use App\Http\Controllers\UserController;

Route::redirect('/', '/user');

Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

Route::get('/user/{user}', [UserController::class, 'edit'])->name('user.edit');

Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');

Route::post('/user', [UserController::class, 'store'])->name('user.store');

Route::delete('/user/{user}', [UserController::class, 'delete'])->name('user.delete');
