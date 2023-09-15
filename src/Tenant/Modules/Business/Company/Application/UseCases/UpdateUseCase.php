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

final class UpdateUseCase
{
    private $repository;

    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $countryId,
        int $id,
        string $name,
        string $businessName,
        int $identificationTypeId,
        string $identification,
        string $email,
        string $address,
        string $telephone,
        string $cellphone,
        string $website,
        bool $status
    ): void {
        $countryId = new CountryId($countryId);
        $id = new Id($id);
        $name = new Name($name);
        $businessName = new BusinessName($businessName);
        $identificationTypeId = new IdentificationTypeId($identificationTypeId);
        $identification = new Identification($identification);
        $email = new Email($email);
        $address = new Address($address);
        $telephone = new Telephone($telephone);
        $cellphone = new Cellphone($cellphone);
        $website = new Website($website);
        $status = new Status($status);

        $company = new Company(
            $countryId,
            $id,
            $name,
            $businessName,
            $identificationTypeId,
            $identification,
            $email,
            $address,
            $telephone,
            $cellphone,
            $website,
            $status
        );
        $this->repository->update($company);
    }

}