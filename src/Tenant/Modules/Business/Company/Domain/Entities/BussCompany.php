<?php

namespace Src\Tenant\Modules\Business\Company\Domain\Entities;

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

final class BussCompany
{
    private $countryId;
    private $id;
    private $name;
    private $businessName;
    private $identificationTypeId;
    private $identification;
    private $email;
    private $address;
    private $telephone;
    private $cellphone;
    private $website;
    private $image;
    private $imageExt;
    private $status;

    public function __construct(
        CountryId $countryId, Id $id, Name $name, BusinessName $businessName, IdentificationTypeId $identificationTypeId, Identification $identification, Email $email, Address $address, Telephone $telephone, Cellphone $cellphone, Website $website, Status $status
    ) {
        $this->countryId = $countryId;
        $this->id = $id;
        $this->name = $name;
        $this->businessName = $businessName;
        $this->identificationTypeId = $identificationTypeId;
        $this->identification = $identification;
        $this->email = $email;
        $this->address = $address;
        $this->telephone = $telephone;
        $this->cellphone = $cellphone;
        $this->website = $website;
        $this->status = $status;
        $this->image = new Image('');
        $this->imageExt = new ImageExt('');
    }

    public function countryId(): ?CountryId
    {
        return $this->countryId();
    }

    public function id(): ?Id
    {
        return $this->id;
    }

    public function name(): ?Name
    {
        return $this->name;
    }

    public function businessName(): ?BusinessName
    {
        return $this->businessName;
    }

    public function identificationTypeId(): ?IdentificationTypeId
    {
        return $this->identificationTypeId;
    }

    public function identification(): ?Identification
    {
        return $this->identification;
    }

    public function email(): ?Email
    {
        return $this->email;
    }

    public function address(): ?Address
    {
        return $this->address();
    }

    public function telephone(): ?Telephone
    {
        return $this->telephone();
    }

    public function cellphone(): ?Cellphone
    {
        return $this->cellphone();
    }

    public function website(): ?Website
    {
        return $this->website();
    }

    public function image(): ?Image
    {
        return $this->image;
    }

    public function imageExt(): ?ImageExt
    {
        return $this->imageExt;
    }

    public function status(): ?Status
    {
        return $this->status;
    }

}