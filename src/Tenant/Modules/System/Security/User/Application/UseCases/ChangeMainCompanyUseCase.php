<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Application\UseCases;

use Src\Tenant\Modules\System\Security\User\Domain\Interfaces\UserRepositoryInterface;
use Src\Tenant\Modules\System\Security\User\Domain\Entities\SecuUser as User;

use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Id;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\CountryId;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\CompanyId;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Main;

final class ChangeMainCompanyUseCase
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $countryId,
        int $companyId,
        int $userId,
        bool $main
    ): void {
        $countryId = new CountryId($countryId);
        $companyId = new CompanyId($companyId);
        $userId = new Id($userId);
        $main = new Main($main);

        $this->repository->changeMainCompany($countryId, $companyId, $userId, $main);
    }
}