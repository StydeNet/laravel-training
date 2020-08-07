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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return 'GET response';
});

Route::post('/user', function () {
    return 'POST response';
});

Route::put('/user/1', function () {
    return 'PUT response';
});

Route::patch('/user/1', function () {
    return 'PATCH response';
});

Route::delete('/user/1', function () {
    return 'DELETE response';
});

Route::options('/user', function () {
    return 'OPTIONS response';
});

Route::match(['get', 'post'], '/home', function () {
    return 'MATCH response';
});

Route::any('/ping', function () {
    return 'Responding to ANY type of request';
});

Route::redirect('/old-url', '/new-url');

Route::permanentRedirect('/removed-url', '/new-permanent-url');

Route::view('/welcome', 'welcome');
