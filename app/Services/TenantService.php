<?php

namespace App\Services;

use Symfony\Component\CssSelector\Exception\ParseException;
use App\Models\Landlord\Modules\System\Security\Tenant;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

use Exception;

class TenantService
{
    private static $tenant;
    private static $domain;
    private static $database;

    public static function switchToTenant(Tenant $tenant)
    {
        if (!$tenant instanceof Tenant) {
            throw ValidationException::withMessages(['InstanceOfTenant' => 'Non-instantiated object of class Tenant.']);
        }

        self::$tenant = $tenant;
        self::$domain = $tenant->domain;
        self::$database = $tenant->database;

        DB::purge('landlord');
        DB::purge('tenant');
        Config::set('database.connections.tenant.database', $tenant->database);
        DB::connection('tenant')->reconnect();
        DB::setDefaultConnection('tenant');
    }


    public static function switchToDefault(Tenant $tenant)
    {
        DB::purge('landlord');
        DB::purge('tenant');
        DB::connection('landlord')->reconnect();
        DB::setDefaultConnection('landlord');
    }

    public static function getTenant()
    {
        return self::$tenant;
    }

}
