<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\Business\Company\Infrastructure\Adapters\FacadesDB;

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

use Illuminate\Support\Facades\DB;

final class CompanyFacadesDBAdapter implements CompanyRepositoryInterface
{
    public function __construct()
    {
    }

    public function getAll()
    {
        $companies = DB::select(
            'call sp_buss_companies(?,?,?,?,?,?,?,?,?,?,?,?,?)',
            array(
                "S",
                1,
                0,
                '',
                '',
                0,
                '',
                '',
                '',
                '',
                '',
                '',
                true
            )
        );

        $companies = json_decode(json_encode($companies), true);
        return $companies;
    }

    public function getOne(CountryId $countryId, Id $id): ?Company
    {
        $company = DB::select(
            'call sp_buss_companies(?,?,?,?,?,?,?,?,?,?,?,?,?)',
            array(
                "L",
                $countryId,
                $id,
                '',
                '',
                0,
                '',
                '',
                '',
                '',
                '',
                '',
                true
            )
        );

        $company = json_decode(json_encode($company), true);
        return new Company(
            new CountryId($company->countryId),
            new Id($company->id),
            new Name($company->name),
            new BusinessName($company->businessName),
            new IdentificationTypeId($company->identificationTypeId),
            new Identification($company->identification),
            new Email($company->email),
            new Address($company->address),
            new Telephone($company->telephone),
            new Cellphone($company->cellphone),
            new Website($company->website),
            new Status($company->status),
        );
    }

    public function create(Company $company): void
    {
        DB::select(
            'call sp_buss_companies(?,?,?,?,?,?,?,?,?,?,?,?,?)',
            array(
                "I",
                $company->countryId()->value(),
                $company->id()->value(),
                $company->name()->value(),
                $company->businessName()->value(),
                $company->identificationTypeId()->value(),
                $company->identification()->value(),
                $company->email()->value(),
                $company->address()->value(),
                $company->telephone()->value(),
                $company->cellphone()->value(),
                $company->website()->value(),
                $company->status()->value()
            )
        );
    }

    public function update(Company $company): void
    {

        DB::select(
            'call sp_buss_companies(?,?,?,?,?,?,?,?,?,?,?,?,?)',
            array(
                "U",
                $company->countryId()->value(),
                $company->id()->value(),
                $company->name()->value(),
                $company->businessName()->value(),
                $company->identificationTypeId()->value(),
                $company->identification()->value(),
                $company->email()->value(),
                $company->address()->value(),
                $company->telephone()->value(),
                $company->cellphone()->value(),
                $company->website()->value(),
                $company->status()->value()
            )
        );

    }

    public function delete(CountryId $countryId, Id $id): void
    {
        DB::select(
            'call sp_buss_companies(?,?,?,?,?,?,?,?,?,?,?,?,?)',
            array(
                "D",
                $countryId,
                $id,
                '',
                '',
                0,
                '',
                '',
                '',
                '',
                '',
                '',
                true
            )
        );
    }
}