<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Domain\Interfaces;

use Src\Tenant\Modules\System\Security\User\Domain\Entities\SecuUser as User;

use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Id;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Name;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Email;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Password;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Status;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Language;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Avatar;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\AvatarType;

use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\CountryId;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\CompanyId;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Main;

interface UserRepositoryInterface
{
    public function getAll();

    public function getOne(Id $id): ?User;

    public function create(User $user): void;

    public function update(User $user): void;

    public function delete(Id $id): void;

    public function changeLanguage(Id $id, Language $language): void;

    public function getAllAssignedCompanies(CountryId $countryId, Id $id);

    public function changeMainCompany(CountryId $countryId, CompanyId $companyId, Id $id, Main $main): void;

    public function getMainCompany(Id $id);
}