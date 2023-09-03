<?php

namespace App\Console\Commands\Tenant;

use App\Models\Landlord\Modules\System\Security\Tenant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use App\Services\TenantService;

class SeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:seeder {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tenants seeders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $class = $this->argument('class');
        $tenants = Tenant::get();

        $tenants->each(function ($tenant) use ($class) {
            TenantService::switchToTenant($tenant);
            $this->info('Start seeding: ' . $tenant->domain);
            $this->info('---------------------------------------');
            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\Tenant\\' . $class,
                '--database' => 'tenant'
            ]);

            $this->info(Artisan::output());
        });
        return Command::SUCCESS;
    }
}