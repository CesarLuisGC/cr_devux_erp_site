<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Domain\ValueObjects;

use Src\Utils\Validations\Types as Validate;

final class Main
{
    private $value;

    public function __construct(bool $value)
    {
        $validate = new Validate;
        $validate->typeBoolean($value);

        $this->value = $value;
    }

    public function value(): bool
    {
        return $this->value;
    }
}