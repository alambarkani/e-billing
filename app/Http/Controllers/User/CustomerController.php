<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->keyword) {
            $customers = Customer::search($request->keyword)->latest()->paginate(5);
        } else {
            $customers = Customer::latest()->paginate(5);
        }
        return view('pages.admin.data.customer.index', compact('customers'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|string',
            'account' => 'required|string|unique:users,account',
            'identity' => 'required|string|unique:customers,identity',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'internet_package_id' => 'required',

        ]);
    }
}
