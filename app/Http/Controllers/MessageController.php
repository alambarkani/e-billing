<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FonnteService;

class MessageController extends Controller
{
    public function index()
    {
        return view('pages.admin.message.index');
    }

    public function send(Request $request)
    {
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
                'target' => $request->phone,
                'message' => $request->message,
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization:' . env('FONNTE_API_KEY')
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

    public function conn()
    {
        return view('pages.admin.message.wagwconn.index');
    }

    public function updateConn(Request $request)
    {
        $data = $request->only(['app_name', 'app_env']);

        // Update .env file
        $this->updateEnv($data);

        return redirect()->back()->with('success', 'Token updated successfully.');
    }

    protected function updateEnv($data)
    {
        $envPath = base_path('.env');

        if (file_exists($envPath)) {
            foreach ($data as $key => $value) {
                // Sanitize key and value
                $key = strtoupper($key);
                $value = trim($value);

                // Replace the value in .env file
                file_put_contents($envPath, preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}={$value}",
                    file_get_contents($envPath)
                ));
            }
        }
    }
}
