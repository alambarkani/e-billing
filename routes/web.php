<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/register', function () {
    return view('pages.register');
});

//create route for get user from database
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});
//Route::get('/users/{id}', [UserController::class, 'getUser']);
//Route::post('/users/create', [UserController::class, 'createUser']);
//Route::put('/users/{id}', [UserController::class, 'editUser']);
//Route::delete('/users/{id}', [UserController::class, 'deleteUser']);
