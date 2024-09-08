<?php

namespace App\Http\Controllers\Admin\Vendor;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteController extends Controller
{
    //

    public function connection()
    {
        return view('pages.admin.notification.connection.index');
    }

    public function connectionPost(Request $request)
    {
        updateEnv('FONNTE_ACCOUNT_TOKEN', $request->token);
        return back()->with('success', 'Fonnte Token Updated');
    }


    public function index()
    {

        $response = getDevicesProfile();
        $devices = json_decode($response, true);

        if (!$devices['status']) {
            return response()->view('errors.500',
                [
                    'exceptionMessage' => 'Invalid Account Token',
                    'exceptionSubMessage' => 'Pastikan account token di wa-gateway connection sudah benar'
                ], 500);
        }

        return view('pages.admin.notification.device.index', compact('devices'));
    }

    public function create()
    {
        return view('pages.admin.notification.device.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        try {
            Http::withHeaders([
                'Authorization' => env('FONNTE_ACCOUNT_TOKEN'),
            ])->post('https://api.fonnte.com/add-device', [
                'name' => $request->name,
                'device' => $request->phone,
            ]);
        } catch (ConnectionException $e) {
            Log::error($e->getMessage());
            return response()->view('errors.500');
        }

        return redirect()->route('super-admin.wa-gateway.device.index')->with('success', 'Berhasil menambahkan device baru');
    }

    public function edit($token)
    {
        return view('pages.admin.notification.device.edit', compact('token'));
    }

    public function update(Request $request, $token)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/update-device', [
                'name' => $request->name,
            ]);
        } catch (ConnectionException $e) {
            Log::error($e->getMessage());
            return response()->view('errors.500');
        }

        return redirect()->route('super-admin.wa-gateway.device.index')->with('success', 'Berhasil mengedit nama device');
    }

    public function deleteRequest($token)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/delete-device', [
                'otp' => ''
            ]);
        } catch (ConnectionException $e) {
            Log::error($e->getMessage());
            return response()->view('errors.500');
        }

        return response()->json(json_decode($response, true));
    }

    public function destroy($token, Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $otp = $request->otp;

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/delete-device', [
                'otp' => $otp
            ]);
        } catch (ConnectionException $e) {
            Log::error($e->getMessage());
            return response()->view('errors.500');
        }

        $response = json_decode($response, true);

        if ($response['status']) {
            return redirect()->route('super-admin.wa-gateway.device.index')->with('success', $response['detail']);
        } else {
            return redirect()->route('super-admin.wa-gateway.device.index')->withErrors($response['reason']);
        }
    }

    public function connecting($token, Request $request)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/qr', [
                'type' => 'qr',
                'whatsapp' => $request->device,
            ]);
        } catch (ConnectionException $e) {
            Log::error($e->getMessage());
            return response()->view('errors.500');
        }

        return response()->json(json_decode($response, true));
    }

    public function disconnecting($token)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/disconnect');
        } catch (ConnectionException $e) {
            Log::error($e->getMessage());
            return response()->view('errors.500');
        }

        $response = json_decode($response, true);
        return back()->with('success', $response['detail']);
    }
}
