<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected $client;
    protected $apiKey;
    protected $senderPhone;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('FONNTE_API_KEY');
        $this->senderPhone = env('FONNTE_SENDER_PHONE');
    }

    public function sendMessage($to, $message)
    {
        Log::info("Sending message to {$to} with content: {$message}");

        $url = 'https://api.fonnte.com/send';

        try {
            $response = $this->client->post($url, [
                'headers' => [
                    'Authorization' => $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'phone' => $to,
                    'type' => 'text',
                    'text' => $message,
                    'sender' => $this->senderPhone,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return json_decode($e->getResponse()->getBody(), true);
            }

            return ['error' => 'Request failed'];
        }
    }
}
