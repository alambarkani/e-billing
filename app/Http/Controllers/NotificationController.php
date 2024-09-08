<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::latest()->paginate(10);
        return view('pages.admin.notification.message.index', compact('notifications'));
    }

    public function create()
    {
        $devices = json_decode(getDevicesProfile(), true);

        $connectedDevice = [];
        if ($devices){
            foreach($devices['data'] as $device){
                if($device['status'] === 'connect'){
                    $connectedDevice[] = $device;
                }
            }
        }

        return view('pages.admin.notification.message.create', compact('connectedDevice'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required|string',
            'message' => 'required|string',
            'sender' => 'required|json',
        ]);

        $sender = json_decode($request->sender, true);

        Notification::create([
            'type' => $request->type,
            'title' => $request->title,
            'message' => $request->message,
            'sender' => $sender['number'],
            'token' => $sender['token']
        ]);

        return redirect()->route('admin.notification.message.index')->with("success", "Notification created successfully");
    }

    public function edit(Notification $notification)
    {
        $devices = json_decode(getDevicesProfile(), true);

        $connectedDevice = [];
        if ($devices){
            foreach($devices['data'] as $device){
                if($device['status'] === 'connect'){
                    $connectedDevice[] = $device;
                }
            }
        }

        return view('pages.admin.notification.message.edit', compact('notification', 'connectedDevice'));
    }

    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required|string',
            'message' => 'required|string',
            'sender' => 'required|json',
        ]);

        $device = json_decode($request->sender, true);
        $notification->update([
            'type' => $request->type,
            'title' => $request->title,
            'message' => $request->message,
            'sender' => $device['number'],
            'token' => $device['token'],
        ]);

        return redirect()->route('admin.notification.index')->with("success", "Notification updated successfully");
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return back()->with("success", "Berhasil menghapus notification message");
    }

    public function send(Customer $customer)
    {
        if (!$customer->paid || $customer->in_arrears){
            $message = Notification::where('type', 'monthly')->first();
            if ($message){
                sendWhatsappMessage($customer->phone, $message, $message->token);
                return redirect()->route('admin.data.customer.index')->with("success", "Berhasil mengirim notifikasi ke ". $customer->name);
            }else{
                return redirect()->route('admin.data.customer.index')->with("errors", "Gagal mengirim notifikasi ke ". $customer->name . ". Dikarenakan message notifikasi belum di set");
            }
        }
        return redirect()->route('admin.data.customer.index')->with('errors', "Gagal mengirim notifikasi ke ". $customer->name . ". Dikarenakan pelanggan sudah lunas");
    }
    public function show(Notification $notification)
    {

    }

}
