<?php

namespace Database\Seeders\Landlord;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Landlord\Modules\System\Security\Tenant;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            ['domain' => 'app1.cr_devux_erp_site.test', 'database' => 'tenant_app1'],
            ['domain' => 'app2.cr_devux_erp_site.test', 'database' => 'tenant_app2'],
            ['domain' => 'app3.cr_devux_erp_site.test', 'database' => 'tenant_app3'],
        ];

        Tenant::Insert($tenants);

        \App\Models\User::create([
            'name' => 'landlord',
            'email' => 'landlord@gmail.com',
            'password' => \bcrypt('12345678'),
        ]);

    }
}