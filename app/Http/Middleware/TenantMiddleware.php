<?php

namespace App\Http\Middleware;

use App\Models\Landlord\Modules\System\Security\Tenant;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Services\TenantService;
use Illuminate\Http\Request;
use Closure;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $tenant = Tenant::where('domain', $host)->first();
        TenantService::switchToTenant($tenant);
        //dd(DB::getConnections());
        //dd(DB::table('users')->get($columns = ['*'])->toArray());
        return $next($request);
    }
}