<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == "customer") {
                return view('pages.customer.dashboard');
            } else if (Auth::user()->role != 'customer') {
                return redirect()->route('admin.dashboard');
            }
        } else {
            return redirect('/login');
        }
    }

    public function dashboard()
    {
        return view('pages.customer.dashboard');
    }
}
