<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\Business\Company\Infrastructure\Controllers;

use Illuminate\Http\Request;

use Src\Tenant\Modules\Business\Company\Application\UseCases\GetAllUseCase;
use Src\Tenant\Modules\Business\Company\Application\UseCases\GetOneUseCase;
use Src\Tenant\Modules\Business\Company\Application\UseCases\CreateUseCase;
use Src\Tenant\Modules\Business\Company\Application\UseCases\UpdateUseCase;
use Src\Tenant\Modules\Business\Company\Application\UseCases\DeleteUseCase;

use Src\Tenant\Modules\Business\Company\Infrastructure\Adapters\FacadesDB\CompanyFacadesDBAdapter;
use Src\Tenant\Modules\Business\Company\Infrastructure\Adapters\Eloquent\CompanyEloquentAdapter;

final class CompanyController
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CompanyFacadesDBAdapter();
    }

    public function getAll()
    {
        try {
            $getAllUseCase = new GetAllUseCase($this->repository);
            $companies = $getAllUseCase->__invoke();
            return $companies;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getOne(Request $request)
    {
        try {
            $id = (int) $request->id;

            $getOneUseCase = new GetOneUseCase($this->repository);
            $company = $getOneUseCase->__invoke($id);
            return $company;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function create(Request $request)
    {
        try {
            $countryId = 0;
            $id = 0;
            $name = $request->name;
            $businessName = '';
            $identificationTypeId = 1;
            $identification = '';
            $email = $request->email;
            $address = '';
            $telephone = '';
            $cellphone = '';
            $website = '';
            $image = $request->image ?? '';
            $imageExt = $request->imageExt ?? '';
            $status = $request->status ?? true;

            $createCompany = new CreateUseCase($this->repository);
            $createCompany->__invoke(
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

            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request)
    {
        try {
            $id = (int) $request->id;

            $getOneUseCase = new GetOneUseCase($this->repository);
            $company = $getOneUseCase->__invoke($id);

            $country_id = 0;
            $id = 0;
            $name = $request->name ?? $company->name()->value();
            $businessName = $request->businessName ?? $company->businessName()->value();
            $identification_type_id = $request->identification_type_id ?? $company->identificationTypeId()->value();
            $identification = $request->identification ?? $company->identification()->value();
            $email = $request->email ?? $company->email()->value();
            $address = $request->address ?? $company->address()->value();
            $telephone = $request->telephone ?? $company->telephone()->value();
            $cellphone = $request->cellphone ?? $company->cellphone()->value();
            $website = $request->website ?? $company->website()->value();
            $image = $request->image ?? $company->image()->value();
            $imageExt = $request->imageExt ?? $company->imageExt()->value();
            $status = $request->status ?? $company->status()->value();

            $updateUseCase = new UpdateUseCase($this->repository);
            $updateUseCase->__invoke(
                $country_id,
                $id,
                $name,
                $businessName,
                $identification_type_id,
                $identification,
                $email,
                $address,
                $telephone,
                $cellphone,
                $website,
                $status
            );

            $updatedCompany = $getOneUseCase->__invoke($id);
            return $updatedCompany;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(Request $request)
    {
        try {
            $id = (int) $request->id;
            $deleteUseCase = new DeleteUseCase($this->repository);
            $deleteUseCase->__invoke($id);
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }



}