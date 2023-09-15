<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\Business\Company\Application\UseCases;

use Src\Tenant\Modules\Business\Company\Domain\Interfaces\CompanyRepositoryInterface;

final class GetAllUseCase
{
    private $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke()
    {
        $companies = $this->repository->getAll();
        return $companies;
    }

}