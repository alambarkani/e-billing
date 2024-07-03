<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected $fonnteApiKey;

    public function __construct()
    {
        $this->fonnteApiKey = env('FONNTE_API_KEY'); // Ensure this is set in your .env file
    }

    public function sendMessage($phoneNumbers, $message)
    {
        $phoneNum = '';
        if (is_array($phoneNumbers)) {
            foreach ($phoneNumbers as $phoneNumber) {
                $phoneNum .= $phoneNumber . ',';
            }
        } else {
            $phoneNum = $phoneNumbers;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $phoneNum,
                'message' => $message,
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization:' . $this->fonnteApiKey
            ),
        ));

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        }
        curl_close($curl);

        if (isset($error_msg)) {
            echo $error_msg;
        }
        echo $response;

        return response()->json($response);
    }
}
