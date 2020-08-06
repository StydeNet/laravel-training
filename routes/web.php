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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;

Route::any('/', function () {
    return view('welcome');
});

Route::any('/request-using-di', function (Request $request) {
    return $request->method();
});

Route::any('/request-using-facade', function () {
    return FacadesRequest::method();
});

Route::any('/request-using-helper', function () {
    return request()->method();
});

Route::any('/get-all-request-input', function (Request $request) {
    return $request->all();
});

Route::any('/get-specific-input', function (Request $request) {
    return $request->get('email');
});

Route::any('/get-specific-value', function (Request $request) {
    return $request->input('name');
});

Route::any('/get-specific-value-or-default', function (Request $request) {
    return $request->input('name', 'Undefined');
});

Route::any('/get-specific-query-string-value', function (Request $request) {
    return $request->query('source');
});

Route::any('/get-only', function (Request $request) {
    return $request->only('name', 'email');
});

Route::any('/get-except', function (Request $request) {
    return $request->except('name');
});

Route::any('/get-using-magic-properties', function (Request $request) {
    return $request->email;
});

Route::any('/check-input-present', function (Request $request) {
    // if($request->has('password')) {
    if ($request->has(['password', 'password_confirmation'])) {
        return 'the request has password and confirmation.';
    }
    return 'password and password_confirmation must be present.';
});

Route::any('/check-any-input-present', function (Request $request) {
    if ($request->hasAny(['password', 'name'])) {
        return 'true';
    }
    return 'false';
});

Route::any('/check-input-present-and-filled', function (Request $request) {
    if ($request->filled('password')) {
        return 'the password field is present and filled';
    }
    return 'the password field is missing or empty';
});

Route::any('/check-input-missing', function (Request $request) {
    if ($request->missing('password')) {
        return 'the password field is not present in the request';
    }
    return 'the password field is present in the request';
});
