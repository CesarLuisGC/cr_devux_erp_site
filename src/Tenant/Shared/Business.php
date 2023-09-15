<?php

namespace Src\Tenant\Shared;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Business
{
    public $mainCompany;

    public function getMainCompany()
    {
        try {
            $this->mainCompany = DB::table('secu_users_has_buss_companies')
                ->select('secu_users_has_buss_companies.country_id', 'secu_users_has_buss_companies.company_id', 'buss_companies.name as company_name')
                ->join("buss_companies", "buss_companies.id", "=", "secu_users_has_buss_companies.company_id")
                ->where('secu_users_has_buss_companies.user_id', Auth::user()->id)
                ->where('secu_users_has_buss_companies.main', 1)
                ->get();

            return $this->mainCompany[0];
        } catch (\Exception $e) {
            DB::select(
                'call sp_sys_error_log(?,?,?)',
                array(
                    1,
                    Auth::user()->id,
                    substr($e->getMessage(), 0, 100)
                )
            );

            $notification = [
                'title' => '',
                'message' => '',
                'type' => 'error',
            ];
            return $notification;
        }
    }
}