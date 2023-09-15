<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Infrastructure\Adapters\FacadesDB;

use Src\Tenant\Modules\System\Security\User\Domain\Interfaces\UserRepositoryInterface;
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

use Illuminate\Support\Facades\DB;

use Src\Tenant\Modules\System\Log\Infrastructure\Controllers\RegisterLogController;

final class UserFacadesDBAdapter implements UserRepositoryInterface
{
    private $registerLogController;
    public function __construct()
    {
        $this->registerLogController = new RegisterLogController();
    }

    public function getAll()
    {
        $users = DB::select(
            'call sp_secu_users(?,?,?,?,?,?,?)',
            array(
                "S",
                0,
                '',
                '',
                '',
                '',
                true
            )
        );

        $users = json_decode(json_encode($users), true);
        return $users;
    }

    public function getOne(Id $id): ?User
    {
        $user = DB::select(
            'call sp_secu_users(?,?,?,?,?,?,?)',
            array(
                "L",
                $id,
                '',
                '',
                '',
                '',
                true
            )
        );

        $user = json_decode(json_encode($user), true);
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
        DB::select(
            'call sp_secu_users(?,?,?,?,?,?,?)',
            array(
                "I",
                $user->id()->value(),
                $user->name()->value(),
                $user->email()->value(),
                $user->password()->value(),
                $user->language()->value(),
                $user->status()->value()
            )
        );
    }

    public function update(User $user): void
    {

        DB::select(
            'call sp_secu_users(?,?,?,?,?,?,?)',
            array(
                "U",
                $user->id()->value(),
                $user->name()->value(),
                $user->email()->value(),
                $user->password()->value(),
                $user->language()->value(),
                $user->status()->value()
            )
        );

    }

    public function delete(Id $id): void
    {
        DB::select(
            'call sp_secu_users(?,?,?,?,?,?,?)',
            array(
                "D",
                $id,
                '',
                '',
                '',
                '',
                true
            )
        );
    }

    public function changeLanguage(Id $id, Language $language): void
    {
        DB::select(
            'call sp_secu_users_change_language(?,?,?)',
            array(
                "U",
                $id->value(),
                $language->value(),
            )
        );
    }

    public function getAllAssignedCompanies(CountryId $countryId, Id $id)
    {
        DB::select(
            'call sp_secu_users_has_buss_companies(?,?,?,?,?)',
            array(
                "S",
                $countryId,
                0,
                $id,
                0
            )
        );
    }

    public function changeMainCompany(CountryId $countryId, CompanyId $companyId, Id $id, Main $main): void
    {
        DB::select(
            'call sp_secu_users_has_buss_companies(?,?,?,?,?)',
            array(
                "I",
                $countryId,
                $companyId,
                $id,
                $main
            )
        );
    }

    public function getMainCompany(Id $id)
    {
        try {
            $mainCompany = DB::table('secu_users_has_buss_companies')
                ->select('secu_users_has_buss_companies.country_id', 'secu_users_has_buss_companies.company_id', 'buss_companies.name as company_name')
                ->join("buss_companies", "buss_companies.id", "=", "secu_users_has_buss_companies.company_id")
                ->where('secu_users_has_buss_companies.user_id', $id->value())
                ->where('secu_users_has_buss_companies.main', 1)
                ->get();

            return json_decode(json_encode($mainCompany[0]), true);
        } catch (\Exception $e) {
            $moduleId = 1; //System
            $typeLogId = 3; //Error
            $process = 'getMainCompany';
            $message = $e->getMessage();
            $id = $id->value();
            $route = 'Nothing';

            $this->registerLogController->__invoke($moduleId, $typeLogId, $id, $route, $process, $message);
            throw new \ErrorException($e->getMessage());
        }
    }


}