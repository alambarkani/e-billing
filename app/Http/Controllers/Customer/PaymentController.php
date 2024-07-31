<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function paying(Customer $customer)
    {
        $customer->last_payment = now();
        $customer->paid = true;
        $customer->save();
    }

    public function confirmPaid(Customer $customer)
    {
        $customer->last_payment = now();
        $customer->paid = true;
        $customer->save();
        return redirect()->route('admin.datas.customer.notpaid')->with('success', 'Berhasil Mengkonfirmasi Pembayaran');
    }
}
