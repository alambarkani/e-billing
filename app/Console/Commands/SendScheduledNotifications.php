<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Message;
use App\Services\WhatsAppService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class SendScheduledNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled notification based on due date via WhatsApp';

    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        parent::__construct();
        $this->whatsAppService = $whatsAppService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $today = Carbon::today()->toDateString();
        $customers = Customer::where(['status' => true, 'paid' => false, 'due_date' => $today])->get();
        $phoneNumber = $customers->phone;
        $messages = Message::first();

        $response = $this->whatsAppService->sendMessage($phoneNumber, $messages->message);

        if ($response['status'] == 'success') {
            $this->info('Message sent successfully.');
        } else {
            $this->error('Failed to send message.');
        }
    }
}
