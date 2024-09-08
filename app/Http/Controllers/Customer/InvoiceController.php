<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function bill()
    {
        $company = Company::first();
        return view('pages.customer.bill.index', compact('company'));
    }
}
