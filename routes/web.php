<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\InternetPackageController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\User\CustomerController;
use App\Models\Customer;

Route::get('/', [HomeController::class, 'index']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::middleware(['isCustomer'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('customer.dashboard');
    });

    // Admin and Above
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/adminDashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // Protected routes here
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('users', UserController::class);
            Route::prefix('datas')->name('datas.')->group(function () {
                Route::get('customer/paid', [CustomerController::class, 'paidCustomer'])->name('customer.paid');
                Route::get('customer/notpaid', [CustomerController::class, 'notPaidCustomer'])->name('customer.notpaid');
                Route::post('customer/notpaid/{customer}', [PaymentController::class, 'confirmPaid'])->name('customer.paid.confirm');
                Route::get('customer/arrears', [CustomerController::class, 'arrears'])->name('customer.arrears');
                Route::resource('customer', CustomerController::class);
                Route::resource('internetpackage', InternetPackageController::class);
            });
            Route::prefix('tickets')->name('tickets.')->group(function () {
                Route::get('openticket', [TicketController::class, 'open'])->name('openticket');
                Route::get('problem', [ProblemController::class, 'index'])->name('problem');
                Route::post('problem', [ProblemController::class, 'create'])->name('problem.create');
                Route::put('accept/{customer}', [TicketController::class, 'openAccept'])->name('accept');
                Route::delete('decline/{customer}', [TicketController::class, 'openDecline'])->name('decline');
            });

            Route::prefix('messages')->name('messages.')->group(function () {
                Route::get('wa', [MessageController::class, 'index'])->name('index');
                Route::post('wa', [MessageController::class, 'send'])->name('send');
                Route::get('sendpage', [MessageController::class, 'sendPage'])->name('sendPage');
                Route::get('notifikasi', [MessageController::class, 'notification'])->name('notif');
                Route::post('notifikasi', [MessageController::class, 'updateNotifMessage'])->name('notif.update');
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
