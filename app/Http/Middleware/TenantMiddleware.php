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

        //Se valida si el host es un tenant valido, si por ejemplo es el host landlord omite el manejo de cambio de conexión
        if (!is_null($tenant)) {
            TenantService::switchToTenant($tenant);
        }

        return $next($request);
    }
}