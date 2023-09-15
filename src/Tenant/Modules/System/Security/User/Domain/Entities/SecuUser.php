<?php

namespace Src\Tenant\Modules\System\Security\User\Domain\Entities;

use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Id;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Name;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Email;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Password;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Status;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Language;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\Avatar;
use Src\Tenant\Modules\System\Security\User\Domain\ValueObjects\AvatarType;

final class SecuUser
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $status;
    private $language;
    private $avatar;
    private $avatarType;

    public function __construct(Id $id, Name $name, Email $email, Password $password, Status $status, Language $language, Avatar $avatar, AvatarType $avatarType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->language = $language;
        $this->avatar = $avatar;
        $this->avatarType = $avatarType;
    }

    public function id(): ?Id
    {
        return $this->id;
    }

    public function name(): ?Name
    {
        return $this->name;
    }

    public function email(): ?Email
    {
        return $this->email;
    }

    public function password(): ?Password
    {
        return $this->password;
    }

    public function status(): ?Status
    {
        return $this->status;
    }

    public function language(): ?Language
    {
        return $this->language;
    }

    public function avatar(): ?Avatar
    {
        return $this->avatar;
    }

    public function avatarType(): ?AvatarType
    {
        return $this->avatarType;
    }
}