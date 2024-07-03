<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function open()
    {
        $customers = Customer::where('acc', false)->latest()->paginate(5);
        return view('pages.admin.ticket.open', compact('customers'));
    }

    public function openAccept(Customer $customer)
    {
        $customer->acc = true;
        $customer->status = true;
        $customer->save();
        return redirect()->route('admin.tickets.openticket')->with('success', 'Berhasil menyetujui pelanggan');
    }

    public function openDecline(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.tickets.openticket')->with('success', 'Berhasil menolak pelanggan');
    }

    public function createDisruptionTicket(Request $request)
    {
        return view('pages.admin.ticket.disruption');
    }
}
