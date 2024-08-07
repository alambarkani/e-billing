<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    public function index()
    {
        if (Auth::check() && Auth::user()->role != 'customer') {
            return view('pages.admin.dashboard');
        } else {
            return redirect('/login');
        }
    }
}
