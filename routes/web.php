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

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/route-using-closure', function () {
    return 'Hello world!';
});

Route::get('/route-using-controller-string', 'HomeController@index');

Route::get('/route-using-controller-class', [HomeController::class, 'index']);

Route::get('/route-using-single-action-controller', 'HomeController');
