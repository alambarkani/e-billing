<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Console\Command;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //
        $message = Notification::where('title', 'Reminder')->first();

        $response = getDevicesProfile();
        $devices = json_decode($response, true);
        foreach ($devices as $device) {
            if ($device['status'] == 'connect') {
                $sender = $device;
                sendWhatsappMessage($sender['device'], $message->message, $sender['token']);
                break;
            }
        }

    }
}
