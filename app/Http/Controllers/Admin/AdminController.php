<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Installation;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index()
    {
        $customers = Customer::all();
        $problems = Problem::all();

        return view('pages.admin.dashboard', compact('customers', 'problems'));
    }
}
