<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\Business\Company\Application\UseCases;

use Src\Tenant\Modules\Business\Company\Domain\Interfaces\CompanyRepositoryInterface;
use Src\Tenant\Modules\Business\Company\Domain\Entities\BussCompany as Company;

use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\CountryId;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Id;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Name;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\BusinessName;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\IdentificationTypeId;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Identification;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Email;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Address;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Telephone;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Cellphone;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Website;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Image;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\ImageExt;
use Src\Tenant\Modules\Business\Company\Domain\ValueObjects\Status;

final class GetOneUseCase
{
    private $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): ?Company
    {
        $id = new Id($id);
        $company = $this->repository->getOne($id);
        return $company;
    }

}