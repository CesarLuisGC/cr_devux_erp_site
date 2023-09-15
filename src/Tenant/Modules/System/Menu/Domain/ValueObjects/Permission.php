<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\ValueObjects;

use Src\Tenant\Shared\Validations\Types as Validate;

final class Permission
{
    private $value;

    public function __construct(string $permission)
    {
        $validate = new Validate;
        $validate->typeString($permission);

        $this->value = $permission;
    }

    public function permission(): string
    {
        return $this->value;
    }
}