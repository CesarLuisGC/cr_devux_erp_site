<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Infrastructure\Adapters\FacadesDB;

use Src\Modules\System\Menu\Domain\Interfaces\MenuRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class MenuFacadesDBAdapter implements MenuRepositoryInterface
{
    public function __construct()
    {
    }

    public function getAll(): ?array
    {
        $mainCompany = 1;
        if (!empty(Auth::user()->id)) {
            $mainCompany = DB::table('secu_users_has_buss_companies')
                ->where('user_id', Auth::user()->id)
                ->where('main', 1)
                ->pluck('company_id')->first();
        }

        $data = DB::table('syst_menus')
            ->join('syst_modules', 'syst_modules.id', '=', 'syst_menus.module_id')
            ->join('syst_modules_has_buss_companies', 'syst_modules_has_buss_companies.module_id', '=', 'syst_modules.id')
            ->join('buss_companies', function ($join) {
                $join->on('buss_companies.country_id', '=', 'syst_modules_has_buss_companies.country_id')
                    ->on('buss_companies.id', '=', 'syst_modules_has_buss_companies.company_id');
            })
            ->select('syst_menus.*')
            ->where('syst_modules.status', 1)
            ->where('syst_modules_has_buss_companies.status', 1)
            ->where('syst_menus.status', 1)
            ->where('buss_companies.id', $mainCompany)
            ->orderby('syst_menus.parent')
            ->orderby('syst_menus.order')
            ->orderby('syst_menus.name')
            ->get()
            ->toArray();

        $data = json_decode(json_encode($data), true);
        return $data;
    }

}