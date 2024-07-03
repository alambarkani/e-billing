<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    //
    public function index()
    {
        $customers = Customer::where('status', true)->get();
        return view('pages.admin.ticket.gangguan', compact('customers'));
    }

    public function create(Request $request)
    {
        $problem = new Problem();

        $problem->customer_id = $request->customer_id;
        $problem->description = $request->description;

        return redirect()->route('admin.tickets.problem')->with('success', 'Berhasil Membuat Ticket Gangguan');
    }
}
