<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TripayController extends Controller
{

    public function index()
    {
        return view('pages.admin.payment.index');
    }

    public function conn()
    {
        return view('pages.admin.payment.connection');
    }

    public function getPaymentChannels()
    {
        $apiKey = env('TRIPAY_API_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $responses = json_decode($response, true);
        return view('pages.customer.payment.index', compact('responses'));
    }

    public function confirmPaid(Customer $customer)
    {
        $customer->last_payment = now();
        $customer->paid = true;
        $customer->save();
        return redirect()->route('admin.data.customer.notpaid')->with('success', 'Berhasil Mengkonfirmasi Pembayaran');
    }

    public function transactionList()
    {
        $endpoint = '';
        if (App::environment('production')) {
            $endpoint = 'https://tripay.co.id/api/merchant/transactions';
        }elseif (App::environment('local')) {
            $endpoint = 'https://tripay.co.id/api-sandbox/merchant/transactions';
        }

        $payload = [
            'page' => 1,
            'per_page' => 25,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('TRIPAY_API_KEY'),
            ])->get($endpoint, http_build_query($payload, '', '&'));

            $responses = json_decode($response, true);
            return view('pages.admin.transaction.index', compact('responses'));
        }catch (\Exception $e){
            $error_msg = $e->getMessage();
            Log::error($error_msg);
        }

        return response()->view('errors.404', [], 404);
    }
}
