<?php

namespace App\Console\Commands\Landlord;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use App\Models\Tenant;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'landlord:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Landord migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Start migrating Landlord");
        $this->info("--------------------------------------");
        Artisan::call('migrate --path=database/migrations/Landlord/ --database=landlord');
        $this->info(Artisan::output());

        return Command::SUCCESS;
    }
}