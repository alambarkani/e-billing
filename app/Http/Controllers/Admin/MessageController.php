<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index()
    {
        return view('pages.admin.message.index');
    }

    public function send(Request $request)
    {
        $whatsAppService = new WhatsAppService();
        $whatsAppService->sendMessage($request->phone, $request->message);
    }

    public function notification()
    {
        $notif = Message::first();
        return view('pages.admin.message.notifikasi.index', compact('notif'));
    }

    public function updateNotifMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $notif = Message::firstOrNew([]);
        $notif->message = $request->message;
        $notif->save();
        return redirect()->back()->with('success', 'Notifikasi Berhasil diupdate');
    }


    public function conn()
    {
        return view('pages.admin.message.wagwconn.index');
    }

    public function updateConn(Request $request)
    {
        $data = $request->only(['fonnte_api_key']);

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

    public function sendPage()
    {
        return view('pages.admin.message.notifikasi.send');
    }
}
