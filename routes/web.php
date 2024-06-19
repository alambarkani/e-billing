<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InternetPackageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\User\CustomerController;
use App\Models\Customer;
use Illuminate\Auth\Events\Login;

Route::get('/', [HomeController::class, 'index']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin and Above
    Route::middleware(['isAdmin'])->group(function () {
        // Protected routes here
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('users', UserController::class);
            Route::prefix('datas')->name('datas.')->group(function () {
                Route::get('customer/paid', [CustomerController::class, 'paidCustomer'])->name('customer.paid');
                Route::get('customer/notpaid', [CustomerController::class, 'notPaidCustomer'])->name('customer.notpaid');
                Route::get('customer/arrears', [CustomerController::class, 'arrears'])->name('customer.arrears');
                Route::resource('customer', CustomerController::class);
                Route::resource('internetpackage', InternetPackageController::class);
            });
            Route::prefix('tickets')->name('tickets.')->group(function () {
                Route::get('openticket', [TicketController::class, 'open'])->name('openticket');
                Route::put('accept/{customer}', [TicketController::class, 'openAccept'])->name('accept');
                Route::delete('decline/{customer}', [TicketController::class, 'openDecline'])->name('decline');
            });

            Route::prefix('messages')->name('messages.')->group(function () {
                Route::get('wa', [MessageController::class, 'index'])->name('index');
                Route::post('wa', [MessageController::class, 'send'])->name('send');
            });
        });
    });

    // Super Admin
    Route::middleware(['isSuperAdmin'])->group(function () {
        // Protected routes here
        Route::prefix('superadmin')->name('superadmin.')->group(function () {
            Route::resource('companies', CompanyController::class);
            Route::prefix('wagw')->name('wagw.')->group(function () {
                Route::get('wagwconn', [MessageController::class, 'conn'])->name('conn');
                Route::post('wagwconn', [MessageController::class, 'updateConn'])->name('conn.update');
            });
        });
    });
});
