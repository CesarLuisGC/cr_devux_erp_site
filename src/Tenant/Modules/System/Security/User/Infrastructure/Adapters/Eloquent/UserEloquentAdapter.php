<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\Eloquent;

use Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\Eloquent\UserEloquentModel;
use Src\Tenant\Modules\System\Security\User\Domain\Interfaces\UserRepositoryInterface;

use Src\Tenant\Modules\System\Security\User\Domain\Entities\SecuUser as User;

use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\CountryId;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\CompanyId;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Id;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Name;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Email;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Password;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Status;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Language;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Avatar;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\AvatarType;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Main;

final class UserEloquentAdapter implements UserRepositoryInterface
{
    private $userEloquentModel;

    public function __construct()
    {
        $this->userEloquentModel = new UserEloquentModel();
    }

    public function getAll()
    {
        $users = $this->userEloquentModel::select('id', 'name', 'email', 'status', 'language', 'avatar', 'avatarType')->get();
        $users = json_decode(json_encode($users), true);
        return $users;
    }

    public function getOne(Id $id): ?User
    {
        $user = $this->userEloquentModel
            ->select('id', 'name', 'email', 'status', 'language', 'avatar', 'avatarType')
            ->where('id', $id->value())
            ->firstOrFail();

        return new User(
            new Id($user->id),
            new Name($user->name),
            new Email($user->email),
            new Password($user->password),
            new Status($user->status),
            new Language($user->language),
            new Avatar($user->avatar),
            new AvatarType($user->avatarType)
        );
    }

    public function create(User $user): void
    {
        $data = [
            'name' => $user->name()->value(),
            'email' => $user->email()->value(),
            'password' => $user->password()->value(),
            'status' => $user->status()->value(),
            'language' => $user->language()->value(),
            'avatar' => $user->avatar()->value(),
            'avatarType' => $user->avatarType()->value(),
        ];

        $this->userEloquentModel->create($data);
    }

    public function update(User $user): void
    {
        $data = [
            'name' => $user->name()->value(),
            'email' => $user->email()->value(),
            'password' => $user->password()->value(),
            'status' => $user->status()->value(),
            'language' => $user->language()->value(),
            'avatar' => $user->avatar()->value(),
            'avatarType' => $user->avatarType()->value(),
        ];

        $this->userEloquentModel->findOrFail($user->id()->value())->update($data);
    }

    public function delete(Id $id): void
    {
        $this->userEloquentModel
            ->findOrFail($id->value())
            ->delete();
    }

    public function changeLanguage(Id $id, Language $language): void
    {
    }

    public function getAllAssignedCompanies(CountryId $countryId, Id $id)
    {

    }

    public function changeMainCompany(CountryId $countryId, CompanyId $companyId, Id $id, Main $main): void
    {

    }

    public function getMainCompany(Id $id)
    {

    }




}