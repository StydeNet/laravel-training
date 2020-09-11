<?php

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('users', function () {
        $users = User::all();

        return new \App\Http\Resources\Users($users);
    });

    Route::get('user/{user}', function (User $user) {
        return new UserResource($user);
    });

    Route::get('paged-users', function () {
        $users = User::paginate();

        return new \App\Http\Resources\Users($users);
    });
});
