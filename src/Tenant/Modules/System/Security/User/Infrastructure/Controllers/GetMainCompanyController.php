<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Infrastructure\Controllers;

use Illuminate\Http\Request;

use Src\Tenant\Modules\System\Security\User\Application\UseCases\GetMainCompanyUseCase;

use Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\FacadesDB\UserFacadesDBAdapter;
use Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\Eloquent\UserEloquentAdapter;

final class GetMainCompanyController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new UserFacadesDBAdapter();
    }
    public function __invoke(int $id)
    {
        try {
            $AssignCompanyUseCase = new GetMainCompanyUseCase($this->repository);
            $AssignCompanyUseCase->__invoke($id);

            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }




}