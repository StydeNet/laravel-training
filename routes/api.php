<?php

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

        if (auth()->user()->isAdmin()) {
            $users->makeVisible('email');
        }

        return response([
            'data' => $users,
        ]);
    });

    Route::get('user/{user}', function (User $user) {
        if (auth()->user()->isAdmin()) {
            $user->makeVisible('email');
        }

        return response([
            'data' => $user,
        ]);
    });
});
