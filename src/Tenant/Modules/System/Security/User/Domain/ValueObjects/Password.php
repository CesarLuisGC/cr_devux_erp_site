<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Domain\ValueObjects;

use Src\Utils\Validations\Types as Validate;

final class Password
{
    private $value;

    public function __construct(string $value)
    {
        $validate = new Validate;
        $validate->typeString($value);

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}