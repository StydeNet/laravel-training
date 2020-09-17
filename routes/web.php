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

use App\User;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/user', function (Illuminate\Http\Request $request) {
    $query = User::query();

    if ($request->has('search')) {
        $query->where('name', 'like', "%{$request->get('search')}%")
            ->orWhere('email', 'like', "%{$request->get('search')}%");
    }

    return view('user.index', ['users' => $query->simplePaginate(10)]);
});

Route::get('/user/create', function () {
    return view('user.create');
});

Route::post('/user', function (Illuminate\Http\Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'password' => 'required|confirmed',
    ]);

    User::create($request->only('name', 'email', 'password'));

    return redirect()->to('/user');
})->name('user.store');

Route::delete('/user/{user}', function (User $user) {
    $user->delete();

    return redirect('/user');
})->name('user.delete');
