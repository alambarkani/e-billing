<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TripayController;
use App\Http\Controllers\Admin\Vendor\FonnteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\CustomerPageController;
use App\Http\Controllers\Customer\InvoiceController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (Auth::check()) {
        $userable = Auth::user()->userable;
        if ($userable instanceof Admin) {
            return redirect()->route('admin.dashboard');
        } elseif ($userable instanceof Customer) {
            return redirect()->route('customer.dashboard');
        }
    }
    return redirect()->route('login');
});

Route::get('payment-channel', [TripayController::class, 'getPaymentChannels'])->name('payment.channel');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'registerPost'])->name('register-post');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost'])->name('login-post');
});

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::delete('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    //Customer
    Route::middleware('isCustomer')->group(function () {
        Route::get('dashboard', [CustomerPageController::class, 'index'])->name('customer.dashboard');
        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('payment', [TripayController::class, 'getPaymentChannels'])->name('index');
            Route::get('request-transaction/{customer}', [PaymentController::class, 'requestTransaction'])->name('reqTrans');
        });
        Route::prefix('invoice')->name('invoice.')->group(function () {
            Route::get('bill', [InvoiceController::class, 'bill'])->name('bill');
        });
    });

    // Admin and Above
    Route::middleware('isAdmin')->group(function () {
        // Protected routes here
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

            Route::prefix('data')->name('data.')->group(function () {
                Route::resource('customer', CustomerController::class);
                Route::resource('product', ProductController::class);
                Route::prefix('customers')->name('customer.')->group(function () {
                    Route::get('paid', [CustomerController::class, 'paid'])->name('paid');
                    Route::get('not-paid', [CustomerController::class, 'notPaid'])->name('not-paid');
                    Route::patch('not-paid/paid-confirm/{customer}', [CustomerController::class, 'paidConfirm'])->name('confirm-paid');
                    Route::post('not-paid/{customer}', [TripayController::class, 'confirmPaid'])->name('paid.confirm');
                    Route::get('arrears', [CustomerController::class, 'inArrears'])->name('arrears');
                    Route::post('status/{customer}', [CustomerController::class, 'toggleActivate'])->name('toggle-activate');

                    Route::prefix('registrant')->name('registrant.')->group(function () {
                        Route::get('', [CustomerController::class, 'registrant'])->name('index');
                        Route::patch('accept/{customer}', [CustomerController::class, 'registerAcc'])->name('accept');
                        Route::delete('decline/{customer}', [CustomerController::class, 'registerDec'])->name('decline');
                    });
                });

                Route::prefix('ticket')->name('ticket.')->group(function () {
                    Route::get('problem/entry', [ProblemController::class, 'entry'])->name('problem.entry');
                    Route::patch('problem/entry/{problem}', [ProblemController::class, 'entryAcc'])->name('problem.entry.accept');
                    Route::get('problem/process', [ProblemController::class, 'process'])->name('problem.process');
                    Route::patch('problem/process/{problem}', [ProblemController::class, 'processDone'])->name('problem.process.done');
                    Route::get('problem/close', [ProblemController::class, 'close'])->name('problem.close');

                    Route::post('problem', [ProblemController::class, 'create'])->name('problem.create');
                    Route::delete('problem/clear', [ProblemController::class, 'clear'])->name('problem.clear');
                });

            });

            Route::resource('product', ProductController::class);


            Route::resource('notification', NotificationController::class);
            Route::prefix('notifications')->name('notification.')->group(function () {
                Route::post('send/{customer}', [NotificationController::class, 'send'])->name('send');
            });

            Route::prefix('payment')->name('payment.')->group(function () {
               Route::get('transaction-list', [TripayController::class, 'transactionList'])->name('transaction');
            });
        });
    });

    // Super Admin
    Route::middleware('isSuperAdmin')->group(function () {
        // Protected routes here
        Route::prefix('super-admin')->name('super-admin.')->group(function () {
            Route::resource('companies', CompanyController::class);
            Route::resource('users', UserController::class);
            Route::prefix('payment-gateway')->name('payment-gateway.')->group(function () {
                Route::get('data-payment', [TripayController::class, 'index'])->name('index');
                Route::get('connection', [TripayController::class, 'conn'])->name('connection');
            });
            Route::prefix('wa-gateway')->name('wa-gateway.')->group(function () {
                Route::prefix('connection')->name('connection.')->group(function () {
                   Route::get('', [FonnteController::class, 'connection'])->name('index');
                   Route::post('', [FonnteController::class, 'connectionPost'])->name('connection-post');
                });

                Route::prefix('device')->name('device.')->group(function () {
                    Route::get('', [FonnteController::class, 'index'])->name('index');
                    Route::get('create', [FonnteController::class, 'create'])->name('create');
                    Route::post('create', [FonnteController::class, 'store'])->name('store');
                    Route::get('edit/{token}', [FonnteController::class, 'edit'])->name('edit');
                    Route::put('edit/{token}', [FonnteController::class, 'update'])->name('update');
                    Route::post('delete/{token}', [FonnteController::class, 'deleteRequest'])->name('delete-request');
                    Route::delete('delete/{token}', [FonnteController::class, 'destroy'])->name('destroy');
                    Route::post('connect/{token}', [FonnteController::class, 'connecting'])->name('connecting');
                    Route::post('disconnect/{token}', [FonnteController::class, 'disconnecting'])->name('disconnecting');
                });
            });
        });
    });
});
