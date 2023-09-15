<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\Business\Company\Infrastructure\Adapters\Eloquent;

use Src\Tenant\Modules\Business\Company\Infrastructure\Adapters\Eloquent\CompanyEloquentModel;
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

final class CompanyEloquentAdapter implements CompanyRepositoryInterface
{
    private $companyEloquentModel;

    public function __construct()
    {
        $this->companyEloquentModel = new CompanyEloquentModel();
    }

    public function getAll()
    {
        $companys = $this->companyEloquentModel::select('id', 'name', 'email', 'status', 'language', 'avatar', 'avatarType')->get();
        $companys = json_decode(json_encode($companys), true);
        return $companys;
    }

    public function getOne(CountryId $countryId, Id $id): ?Company
    {
        $company = $this->companyEloquentModel
            ->select('id', 'name', 'email', 'status', 'language', 'avatar', 'avatarType')
            ->where('id', $id->value())
            ->firstOrFail();

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
            new Status($company->status)
        );
    }

    public function create(Company $company): void
    {
        $data = [
            'name' => $company->name()->value(),
            'businessName' => $company->businessName()->value(),
            'identificationTypeId' => $company->identificationTypeId()->value(),
            'identification' => $company->identification()->value(),
            'email' => $company->email()->value(),
            'address' => $company->address()->value(),
            'telephone' => $company->telephone()->value(),
            'cellphone' => $company->cellphone()->value(),
            'website' => $company->website()->value(),
            'status' => $company->status()->value()
        ];

        $this->companyEloquentModel->create($data);
    }

    public function update(Company $company): void
    {
        $data = [
            'name' => $company->name()->value(),
            'businessName' => $company->businessName()->value(),
            'identificationTypeId' => $company->identificationTypeId()->value(),
            'identification' => $company->identification()->value(),
            'email' => $company->email()->value(),
            'address' => $company->address()->value(),
            'telephone' => $company->telephone()->value(),
            'cellphone' => $company->cellphone()->value(),
            'website' => $company->website()->value(),
            'status' => $company->status()->value()
        ];

        $this->companyEloquentModel->findOrFail($company->id()->value())->update($data);
    }

    public function delete(CountryId $countryId, Id $id): void
    {
        $this->companyEloquentModel
            ->findOrFail($id->value())
            ->delete();
    }

}