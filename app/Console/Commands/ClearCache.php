<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleaning the application level Cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        \Log::info(date('d-m-Y'));
        \Artisan::call('config:cache');
        \Log::info( \Artisan::output());
        \Artisan::call('view:clear');
        \Log::info( \Artisan::output());
    }
}
