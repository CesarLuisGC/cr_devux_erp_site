<?php

namespace App\Console\Commands\Tenant;

use App\Models\Landlord\Modules\System\Security\Tenant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Command;
use App\Services\TenantService;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tenants migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenants = Tenant::get();

        $tenants->each(function ($tenant) {
            TenantService::switchToTenant($tenant);
            $this->info('------------------------------------------------------------------------------');
            $this->info("Start migrating: " . $tenant->domain);
            $this->info('------------------------------------------------------------------------------');
            $this->info("\n");
            Artisan::call('migrate --path=database/migrations/Tenant/ --database=tenant');
            $this->info(Artisan::output());
        });

        return Command::SUCCESS;
    }
}