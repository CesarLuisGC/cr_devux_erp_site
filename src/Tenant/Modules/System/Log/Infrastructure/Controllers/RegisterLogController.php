<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Log\Infrastructure\Controllers;

use Illuminate\Http\Request;

use Src\Tenant\Modules\System\Log\Application\UseCases\RegisterLogUseCase;

use Src\Tenant\Modules\System\Log\Infrastructure\Adapters\FacadesDB\LogFacadesDBAdapter;
use Src\Tenant\Modules\System\Log\Infrastructure\Adapters\Eloquent\LogEloquentAdapter;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

final class RegisterLogController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new LogFacadesDBAdapter();
    }
    public function __invoke(int $moduleId, int $typeLogId, int $userId, string $route, string $process, string $message): string
    {
        //Table DB: syst_type_log => 0-Emergency | 1-Alert | 2-Critical | 3-Error | 4-Warning | 5-Notice | 6-Info | 7-Debug
        try {
            //Pendiente obtener y setear las variables de país y empresa actual.
            $countryId = 1;
            $companyId = 1;
            $id = 0;

            $registerLogUseCase = new RegisterLogUseCase($this->repository);
            $registerLogUseCase->__invoke($countryId, $companyId, $moduleId, $id, $typeLogId, $userId, $route, $process, $message);

            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}