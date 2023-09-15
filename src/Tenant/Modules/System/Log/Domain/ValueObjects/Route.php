<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Log\Domain\ValueObjects;

use Src\Utils\Validations\Types as Validate;

final class Route
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