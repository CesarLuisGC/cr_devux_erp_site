<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\ValueObjects;

use Src\Tenant\Shared\Validations\Types as Validate;

final class Status
{
    private $value;

    public function __construct(bool $status)
    {
        $validate = new Validate;
        $validate->typeBoolean($status);

        $this->value = $status;
    }

    public function status(): bool
    {
        return $this->value;
    }
}