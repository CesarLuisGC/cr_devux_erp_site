<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Log\Infrastructure\Adapters\FacadesDB;

use Src\Tenant\Modules\System\Log\Domain\Interfaces\LogRepositoryInterface;
use Src\Tenant\Modules\System\Log\Domain\Entities\SystLog;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

final class LogFacadesDBAdapter implements LogRepositoryInterface
{
    public function registerLog(SystLog $systLog)
    {
        try {
            $result = DB::select(
                'call sp_syst_log(?,?,?,?,?,?,?,?,?)',
                array(
                    'I',
                    $systLog->getCountryId()->value(),
                    $systLog->getCompanyId()->value(),
                    $systLog->getModuleId()->value(),
                    $systLog->getTypeLogId()->value(),
                    $systLog->getUserId()->value(),
                    $systLog->getRoute()->value(),
                    $systLog->getProcess()->value(),
                    substr($systLog->getMessage()->value(), 0, 1000)
                )
            );

            if ($result !== []) {
                $array = json_decode(json_encode($result[0]), true);
                $full_error = $array['v_full_error'];
                throw new \ErrorException($full_error);
            }
        } catch (\Exception $e) {
            /*
                // https://datatracker.ietf.org/doc/html/rfc5424    (Especification RFC 5424)
                Log::emergency($e->getMessage());
                Log::alert($e->getMessage());
                Log::critical($e->getMessage());
                Log::error($e->getMessage());
                Log::warning($e->getMessage());
                Log::notice($e->getMessage());
                Log::info($e->getMessage());
                Log::debug($e->getMessage());
            */

            Log::error(
                'Error:',
                [
                    'countryId' => $systLog->getCountryId()->value(),
                    'companyId' => $systLog->getCompanyId()->value(),
                    'moduleId' => $systLog->getModuleId()->value(),
                    //'id' => $systLog->getId()->value(),
                    'typeLogId' => (int) 3,
                    //Table DB: syst_type_log => 0-Emergency | 1-Alert | 2-Critical | 3-Error | 4-Warning | 5-Notice | 6-Info | 7-Debug
                    'userId' => $systLog->getUserId()->value(),
                    'route' => $systLog->getCountryId()->value(),
                    'process' => $systLog->getCountryId()->value(),
                    'message' => $e->getMessage(),
                    'createdAt' => Carbon::now()
                ]
            );

            throw new \ErrorException($e->getMessage());
            //return $e->getMessage();
        }

    }

}