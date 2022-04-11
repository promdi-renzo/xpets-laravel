<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Reminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "message:reminder";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Artisan command to remind the user";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "My Own Command";
    }
}
