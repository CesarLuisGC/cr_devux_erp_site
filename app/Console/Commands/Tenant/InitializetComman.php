<?php

namespace App\Console\Commands\Tenant;

use App\Models\Landlord\Modules\System\Security\Tenant;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Console\Command;
use App\Services\TenantService;

class InitializetComman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:initializet {tenant} {userMail} {userPassword}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tenant initialization: Tenant registration in Landlord, database created, migration execution and seeds.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $userMail = $this->argument('userMail');
            $userPassword = $this->argument('userPassword');

            $tenantName = $this->argument('tenant');
            $dbName = 'tenant_' . $tenantName;
            $collation = 'utf8mb4-unicode';

            $connection = config('database.default');
            $driver = config("database.connections.{$connection}.driver");

            $domain = Config::get('global.system.url');
            $subdomain = $tenantName;
            $url = $tenantName . '.' . $domain;

            $this->info('------------------------------------------------------------------------------');
            $this->info('Start register tenant (' . $dbName . "') in landlord: ");
            $this->info('------------------------------------------------------------------------------');

            DB::table('tenants')->insert([
                'domain' => $domain,
                'subdomain' => $subdomain,
                'url' => $url,
                'database' => $dbName
            ]);

            switch ($collation) {
                case 'utf8':
                    $coll = "CHARACTER SET utf8 COLLATE utf8_general_ci";
                    break;
                case 'utf8-unicode':
                    $coll = "CHARACTER SET utf8 COLLATE utf8_unicode_ci";
                    break;
                case 'utf8mb4':
                    $coll = "CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
                    break;
                case 'utf8mb4-unicode':
                    $coll = "CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
                    break;
                default:
                    $coll = "CHARACTER SET utf8 COLLATE utf8_general_ci";
                    break;
            }

            $this->info("\n");
            $this->info('------------------------------------------------------------------------------');
            $this->info('Start create database: ' . $dbName);
            $this->info('------------------------------------------------------------------------------');

            $database = DB::Select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = " . "'" . $dbName . "'");

            if (empty($database)) {
                DB::connection($driver)->select('CREATE DATABASE ' . $dbName . ' ' . $coll);
                $this->info("Database '$dbName' with Collation '$coll' has been created successfully!");
            } else {
                $this->info("Database with Name '$dbName' already exists!");
            }

            $tenant = Tenant::where('database', $dbName)->get();
            $tenant->each(function ($tenant) {
                TenantService::switchToTenant($tenant);
                $this->info("\n");
                $this->info('------------------------------------------------------------------------------');
                $this->info("Start migrating " . $tenant->domain);
                $this->info('------------------------------------------------------------------------------');
                Artisan::call('migrate --path=database/migrations/Tenant/ --database=tenant');
                $this->info(Artisan::output());

                $this->info("\n");
                $this->info('------------------------------------------------------------------------------');
                $this->info('Start seeding: ' . $tenant->domain);
                $this->info('------------------------------------------------------------------------------');
                Artisan::call('db:seed', [
                    '--class' => 'Database\\Seeders\\Tenant\\InitializeSeeder',
                    '--database' => 'tenant'
                ]);
                $this->info(Artisan::output());
            });

            $this->info("\n");
            $this->info('------------------------------------------------------------------------------');
            $this->info('Start create User');
            $this->info('------------------------------------------------------------------------------');

            $user = \App\Models\User::create([
                'name' => '',
                'email' => $userMail,
                'password' => \bcrypt($userPassword),
            ])->assignRole('Admin');

            DB::table('secu_users_has_buss_companies')->insert([
                'country_id' => 1,
                'company_id' => 1,
                'user_id' => $user->id,
                'main' => 1
            ]);

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}