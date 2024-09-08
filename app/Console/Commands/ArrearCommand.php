<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Installation;
use Illuminate\Console\Command;

class ArrearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:arrear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pergantian status nunggak menjadi true jika customer belum bayar selama lebih dari 1 bulan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $customer = Installation::query()->where('last_payment', '>', now()->addMonth(1));
        $customer->update(['in_arrears' => true]);
    }
}
