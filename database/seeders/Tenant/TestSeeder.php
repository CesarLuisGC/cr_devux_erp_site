<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Regional
        |--------------------------------------------------------------------------
        */
        $country1 = \Src\Tenant\Modules\System\Regional\Country\Domain\RegiCountry::create([
            'id' => 1,
            'name' => 'Costa Rica',
            'area_code' => '506',
            'iso3' => 'CRI'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Global
        |--------------------------------------------------------------------------
        */
        $identificationTypePhysical = \Src\Tenant\Modules\Business\IdentificationType\Infrastructure\Adapters\Eloquent\IdentificationTypeEloquentModel::create([
            'country_id' => 1,
            'id' => 1,
            'name' => 'Physical',
            'format' => ''
        ]);

        $identificationTypeLegal = \Src\Tenant\Modules\Business\IdentificationType\Infrastructure\Adapters\Eloquent\IdentificationTypeEloquentModel::create([
            'country_id' => 1,
            'id' => 2,
            'name' => 'Legal',
            'format' => ''
        ]);

        $company1 = \Src\Tenant\Modules\Business\Company\Infrastructure\Adapters\Eloquent\CompanyEloquentModel::create([
            'country_id' => 1,
            'id' => 1,
            'name' => 'Company 1',
            'businessName' => 'Business Name 1',
            'identification_type_id' => 2,
            'identification' => '',
            'email' => '',
            'address' => '',
            'telephone' => '',
            'cellphone' => '',
            'website' => '',
            'image' => '',
            'imageExt' => '',
            'status' => 1
        ]);

        $company2 = \Src\Tenant\Modules\Business\Company\Infrastructure\Adapters\Eloquent\CompanyEloquentModel::create([
            'country_id' => 1,
            'id' => 2,
            'name' => 'Company 2',
            'businessName' => 'Business Name 2',
            'identification_type_id' => 2,
            'identification' => '',
            'email' => '',
            'address' => '',
            'telephone' => '',
            'cellphone' => '',
            'website' => '',
            'image' => '',
            'imageExt' => '',
            'status' => 1
        ]);

        /*
        |--------------------------------------------------------------------------
        | Global
        |--------------------------------------------------------------------------
        | Modules
        |--------------------------------------------------------------------------
        */

        $moduleSystem = \Src\Tenant\Modules\System\Module\Domain\SystModule::create([
            'name' => 'System',
        ]);

        $moduleBusiness = \Src\Tenant\Modules\System\Module\Domain\SystModule::create([
            'name' => 'Business',
        ]);

        $moduleInventory = \Src\Tenant\Modules\System\Module\Domain\SystModule::create([
            'name' => 'Inventory',
        ]);

        $moduleBilling = \Src\Tenant\Modules\System\Module\Domain\SystModule::create([
            'name' => 'Billing',
        ]);

        $moduleEMarketing = \Src\Tenant\Modules\System\Module\Domain\SystModule::create([
            'name' => 'EMarketing',
        ]);

        $moduleECommerce = \Src\Tenant\Modules\System\Module\Domain\SystModule::create([
            'name' => 'ECommerce',
        ]);

        $moduleHumanResource = \Src\Tenant\Modules\System\Module\Domain\SystModule::create([
            'name' => 'Human Resource',
        ]);

        $moduleSupportCenter = \Src\Tenant\Modules\System\Module\Domain\SystModule::create([
            'name' => 'Support Center',
        ]);

        $moduleFileManager = \Src\Tenant\Modules\System\Module\Domain\SystModule::create([
            'name' => 'File Manager',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Global
        |--------------------------------------------------------------------------
        | Menus
        |--------------------------------------------------------------------------
        */

        /**
         * Menus System
         */
        $menu_System = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.system',
            'module_id' => $moduleSystem->id,
            'route' => '',
            'icon' => '<i class="ki-solid ki-gear fs-2x"></i>',
            'parent' => 0,
            'order' => 1,
            'permission' => 'system.index'
        ]);

        $menu_system_security = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.security',
            'module_id' => $moduleSystem->id,
            'route' => '',
            'icon' => '',
            'parent' => $menu_System->id,
            'order' => 1,
            'permission' => 'security.index'
        ]);

        $menu_system_security_role = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.role',
            'module_id' => $moduleSystem->id,
            'route' => 'role.index',
            'icon' => '',
            'parent' => $menu_system_security->id,
            'order' => 1,
            'permission' => 'role.index'
        ]);

        $menu_system_security_user = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.user',
            'module_id' => $moduleSystem->id,
            'route' => 'user.index',
            'icon' => '',
            'parent' => $menu_system_security->id,
            'order' => 2,
            'permission' => 'user.index'
        ]);

        /**
         * Menus Business
         */
        $menu_Business = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.business',
            'module_id' => $moduleBusiness->id,
            'route' => '',
            'icon' => '<i class="ki-solid ki-office-bag fs-2x"></i>',
            'parent' => 0,
            'order' => 2,
            'permission' => 'business.index'
        ]);

        $menu_Business_company = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.company',
            'module_id' => $moduleBusiness->id,
            'route' => 'company.index',
            'icon' => '',
            'parent' => $menu_Business->id,
            'order' => 1,
            'permission' => 'company.index'
        ]);

        $menu_Business_branchOffice = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.branchOffice',
            'module_id' => $moduleBusiness->id,
            'route' => 'branchOffice.index',
            'icon' => '',
            'parent' => $menu_Business->id,
            'order' => 2,
            'permission' => 'branchOffice.index'
        ]);

        $menu_Business_cellar = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.cellar',
            'module_id' => $moduleBusiness->id,
            'route' => 'cellar.index',
            'icon' => '',
            'parent' => $menu_Business->id,
            'order' => 3,
            'permission' => 'cellar.index'
        ]);

        /**
         * Menus Business
         */
        $menu_inventory = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.inventory',
            'module_id' => $moduleInventory->id,
            'route' => '',
            'icon' => '<i class="ki-solid ki-delivery-2 fs-2x"></i>',
            'parent' => 0,
            'order' => 3,
            'permission' => 'inventory.index'
        ]);

        $menu_inventory_catalog = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.catalog',
            'module_id' => $moduleInventory->id,
            'route' => '',
            'icon' => '',
            'parent' => $menu_inventory->id,
            'order' => 1,
            'permission' => 'inventory.catalog'
        ]);

        $menu_inventory_process = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.process',
            'module_id' => $moduleInventory->id,
            'route' => '',
            'icon' => '',
            'parent' => $menu_inventory->id,
            'order' => 1,
            'permission' => 'inventory.process'
        ]);

        $menu_inventory_report = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.report',
            'module_id' => $moduleInventory->id,
            'route' => '',
            'icon' => '',
            'parent' => $menu_inventory->id,
            'order' => 1,
            'permission' => 'inventory.report'
        ]);

        $menu_inventory_catalog_category = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.category',
            'module_id' => $moduleInventory->id,
            'route' => 'category.index',
            'icon' => '',
            'parent' => $menu_inventory_catalog->id,
            'order' => 1,
            'permission' => 'inventory.category'
        ]);

        $menu_inventory_catalog_subcategory = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.subcategory',
            'module_id' => $moduleInventory->id,
            'route' => 'subcategory.index',
            'icon' => '',
            'parent' => $menu_inventory_catalog->id,
            'order' => 2,
            'permission' => 'inventory.subcategory'
        ]);

        $menu_inventory_catalog_attribute = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.attribute',
            'module_id' => $moduleInventory->id,
            'route' => 'attribute.index',
            'icon' => '',
            'parent' => $menu_inventory_catalog->id,
            'order' => 3,
            'permission' => 'inventory.attribute'
        ]);

        $menu_inventory_catalog_pricelevel = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.pricelevel',
            'module_id' => $moduleInventory->id,
            'route' => 'pricelevel.index',
            'icon' => '',
            'parent' => $menu_inventory_catalog->id,
            'order' => 4,
            'permission' => 'inventory.pricelevel'
        ]);

        $menu_inventory_catalog_product = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.product',
            'module_id' => $moduleInventory->id,
            'route' => 'product.index',
            'icon' => '',
            'parent' => $menu_inventory_catalog->id,
            'order' => 5,
            'permission' => 'inventory.product'
        ]);

        /**
         * Menus Billing
         */
        $menuBilling = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.billing',
            'module_id' => $moduleBilling->id,
            'route' => '',
            'icon' => '<i class="ki-solid ki-cheque fs-2x"></i>',
            'parent' => 0,
            'order' => 4,
            'permission' => 'billing.index'
        ]);

        /**
         * Menus EMarketing
         */
        $menuEMarketing = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.emarketing',
            'module_id' => $moduleEMarketing->id,
            'route' => '',
            'icon' => '<i class="ki-solid ki-send fs-2x"></i>',
            'parent' => 0,
            'order' => 5,
            'permission' => 'emarketing.index'
        ]);

        /**
         * Menus ECommerce
         */
        $menuECommerce = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.ecommerce',
            'module_id' => $moduleECommerce->id,
            'route' => '',
            'icon' => '<i class="ki-solid ki-basket fs-2x"></i>',
            'parent' => 0,
            'order' => 6,
            'permission' => 'ecommerce.index'
        ]);

        /**
         * Menus HumanResource
         */
        $menuHumanResources = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.humanResources',
            'module_id' => $moduleHumanResource->id,
            'route' => '',
            'icon' => '<i class="ki-solid ki-profile-user fs-2x"></i>',
            'parent' => 0,
            'order' => 7,
            'permission' => 'humanResources.index'
        ]);

        /**
         * Menus SupportCenter
         */
        $menuSupportCenter = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.supportCenter',
            'module_id' => $moduleSupportCenter->id,
            'route' => '',
            'icon' => '<i class="ki-solid ki-rescue fs-2x"></i>',
            'parent' => 0,
            'order' => 8,
            'permission' => 'supportCenter.index'
        ]);

        /**
         * Menus FileManager
         */
        $menuFileManager = \Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\Eloquent\MenuEloquentModel::create([
            'name' => 'syst_menu.fileManager',
            'module_id' => $moduleFileManager->id,
            'route' => '',
            'icon' => '<i class="ki-solid ki-add-files fs-2x"></i>',
            'parent' => 0,
            'order' => 9,
            'permission' => 'fileManager.index'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */
        $role_super_admin = Role::create([
            'name' => 'Admin',
            'description' => 'Role Admin'
        ]);
        $role_default = Role::create([
            'name' => 'operational',
            'description' => 'Role operational'
        ]);

        $user_cgarcia = \App\Models\User::create([
            'name' => 'tenant',
            'email' => 'tenant@gmail.com',
            'password' => \bcrypt('12345678'),
        ])->syncRoles([$role_super_admin]);

        \App\Models\User::factory(50)->create();

        /*
        Permission::create([
            'name' => 'dashboard',
            'description' => 'label.permissionDashboard',
            'menu_id' => $menuDashboard->id
        ])->syncRoles([$role_super_admin]);
        */


        /*
        |--------------------------------------------------------------------------
        | System - Type Logs => 0-Emergency | 1-Alert | 2-Critical | 3-Error | 4-Warning | 5-Notice | 6-Info | 7-Debug
        |--------------------------------------------------------------------------
        */
        DB::table('syst_type_log')->insert([
            'id' => 0,
            'name' => 'Emergency',
            'description' => 'System is unusable',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('syst_type_log')->insert([
            'id' => 1,
            'name' => 'Alert',
            'description' => 'Action must be taken immediately',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('syst_type_log')->insert([
            'id' => 2,
            'name' => 'Critical',
            'description' => 'Critical conditions',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('syst_type_log')->insert([
            'id' => 3,
            'name' => 'Error',
            'description' => 'Error conditions',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('syst_type_log')->insert([
            'id' => 4,
            'name' => 'Warning',
            'description' => 'Warning conditions',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('syst_type_log')->insert([
            'id' => 5,
            'name' => 'Notice',
            'description' => 'Normal but significant condition',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('syst_type_log')->insert([
            'id' => 6,
            'name' => 'Info',
            'description' => 'Informational messages',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('syst_type_log')->insert([
            'id' => 7,
            'name' => 'Debug',
            'description' => 'Debug-level messages',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        | secu_roles_has_buss_companies
        |--------------------------------------------------------------------------
        */
        DB::table('secu_roles_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'role_id' => $role_super_admin->id,
        ]);

        DB::table('secu_roles_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 2,
            'role_id' => $role_super_admin->id,
        ]);

        DB::table('secu_roles_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'role_id' => $role_default->id,
        ]);

        DB::table('secu_roles_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 2,
            'role_id' => $role_default->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        | secu_buss_companies_has_syst_modules
        |--------------------------------------------------------------------------
        */
        DB::table('syst_modules_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'module_id' => $moduleSystem->id
        ]);

        DB::table('syst_modules_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'module_id' => $moduleBusiness->id
        ]);

        DB::table('syst_modules_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'module_id' => $moduleInventory->id
        ]);

        DB::table('syst_modules_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'module_id' => $moduleBilling->id
        ]);

        DB::table('syst_modules_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'module_id' => $moduleEMarketing->id
        ]);

        DB::table('syst_modules_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'module_id' => $moduleECommerce->id
        ]);

        DB::table('syst_modules_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'module_id' => $moduleHumanResource->id
        ]);

        DB::table('syst_modules_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'module_id' => $moduleSupportCenter->id
        ]);

        DB::table('syst_modules_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'module_id' => $moduleFileManager->id
        ]);

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        | secu_users_has_buss_companies
        |--------------------------------------------------------------------------
        */

        DB::table('secu_users_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 1,
            'user_id' => $user_cgarcia->id,
            'main' => 1
        ]);

        DB::table('secu_users_has_buss_companies')->insert([
            'country_id' => 1,
            'company_id' => 2,
            'user_id' => $user_cgarcia->id,
            'main' => 0
        ]);

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        | permissions
        |--------------------------------------------------------------------------
        */
        Permission::create([
            'name' => 'business.index',
            'description' => 'business_label.permissionIndex',
            'menu_id' => $menu_Business->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'company.index',
            'description' => 'business_label.permissionIndex',
            'menu_id' => $menu_Business_company->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'branchoffice.index',
            'description' => 'business_label.permissionIndex',
            'menu_id' => $menu_Business_branchOffice->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'cellar.index',
            'description' => 'business_label.permissionIndex',
            'menu_id' => $menu_Business_cellar->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'system.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menu_System->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'security.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menu_system_security->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'role.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menu_system_security_role->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'user.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menu_system_security_user->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'inventory.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menu_inventory->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'billing.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menuBilling->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'emarketing.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menuEMarketing->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'ecommerce.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menuECommerce->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'humanResources.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menuHumanResources->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'supportCenter.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menuSupportCenter->id
        ])->syncRoles([$role_super_admin]);

        Permission::create([
            'name' => 'fileManager.index',
            'description' => 'system_label.permissionIndex',
            'menu_id' => $menuFileManager->id
        ])->syncRoles([$role_super_admin]);


    }

}