<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Application\UseCases;

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

final class UpdateUseCase
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(
        int $id,
        string $pName,
        string $pEmail,
        string $password,
        bool $status,
        string $language,
        string $avatar,
        string $avatarType
    ): void {
        $id = new Id($id);
        $name = new Name($pName);
        $email = new Email($pEmail);
        $password = new Password($pEmail);
        $status = new Status($status);
        $language = new Language($language);
        $avatar = new Avatar($avatar);
        $avatarType = new AvatarType($avatarType);

        $user = new User($id, $name, $email, $password, $status, $language, $avatar, $avatarType);
        $this->repository->update($user);
    }

}