<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function open()
    {
        $customers = Customer::where('status', false)->get();
        return view('pages.admin.ticket.open', compact('customers'));
    }

    public function openAccept(Customer $customer)
    {
        $customer->status = true;
        $customer->save();
        return redirect()->route('admin.tickets.openticket')->with('success', 'Berhasil menyetujui pelanggan');
    }

    public function openDecline(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.tickets.openticket')->with('success', 'Berhasil menolak pelanggan');
    }
}
