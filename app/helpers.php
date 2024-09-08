<?php

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Artisan;

if (!function_exists('updateEnv')) {
    function updateEnv($key, $value): void
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            // Ambil isi dari .env
            $envContent = file_get_contents($path);

            // Cari apakah key sudah ada di .env
            $pattern = "/^$key=(.*)$/m";

            if (preg_match($pattern, $envContent)) {
                // Jika ditemukan, tentukan nilai lama
                $oldValue = preg_replace($pattern, '$1', $envContent);

                // Bersihkan tanda kutip ganda pada nilai lama, jika ada
                $oldValue = trim($oldValue, '"');

                // Tambahkan tanda kutip jika ada karakter khusus
                if (strpos($value, ' ') !== false || strpos($value, '#') !== false) {
                    $value = '"' . $value . '"';
                }

                // Ganti nilai lama dengan nilai baru
                $envContent = preg_replace($pattern, "$key=$value", $envContent);
            } else {
                // Jika key tidak ditemukan, tambahkan key=value di akhir file
                $envContent .= PHP_EOL . "$key=$value";
            }

            // Tulis kembali isi .env yang sudah diupdate
            file_put_contents($path, $envContent);
        }

        // Set nilai env pada runtime
        putenv("$key=$value");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

if(!function_exists('sendWhatsappMessage')){
    function sendWhatsappMessage($number, $text, $token): void
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $number,
                'message' => $text,
                'delay' => '2',
                'countryCode' => '62'
            ]);

            if ($response->failed()) {
                throw new Exception("Request failed: " . $response->body());
            }

        } catch (Exception $e) {
            $error_msg = $e->getMessage();
            Log::error($error_msg);
        }

    }
}

if (!function_exists('getDevicesProfile')){
    function getDevicesProfile(): PromiseInterface|int|\Illuminate\Http\Client\Response
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_ACCOUNT_TOKEN'),
            ])->post('https://api.fonnte.com/get-devices');

            if ($response->failed()) {
                throw new Exception("Request failed: " . $response->body());
            }
            return $response;
        } catch (Exception $e){
            $error_msg = $e->getMessage();
            Log::error($error_msg);
        }
        return 0;
    }
}

