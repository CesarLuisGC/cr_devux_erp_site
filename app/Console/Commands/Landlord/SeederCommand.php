<?php

namespace App\Console\Commands\Landlord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;

class SeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'landlord:seed {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $class = $this->argument('class');
        $this->info('Start seeding Landlord');
        $this->info('---------------------------------------');
        Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\Landlord\\' . $class,
            '--database' => 'landlord'
        ]);

        $this->info(Artisan::output());
        return Command::SUCCESS;
    }
}