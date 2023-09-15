<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Infrastructure\Controllers;

use Illuminate\Http\Request;

use Src\Tenant\Modules\System\Security\User\Application\UseCases\ChangeMainCompanyUseCase;

use Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\FacadesDB\UserFacadesDBAdapter;
use Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\Eloquent\UserEloquentAdapter;

final class ChangeAssignedCompanyController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserFacadesDBAdapter();
    }
    public function __invoke(int $countryId, int $companyId, int $id, bool $main)
    {
        try {
            $AssignCompanyUseCase = new ChangeMainCompanyUseCase($this->repository);
            $AssignCompanyUseCase->__invoke($countryId, $companyId, $id, $main);

            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }




}