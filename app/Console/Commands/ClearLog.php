<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class ClearLog extends Command
{
    protected $signature = 'log:clear';
    protected $description = 'Clear the laravel.log file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Clear the laravel.log file
        File::put(storage_path('logs/laravel.log'), '');

        $this->info('laravel.log file has been cleared.');
    }
}
