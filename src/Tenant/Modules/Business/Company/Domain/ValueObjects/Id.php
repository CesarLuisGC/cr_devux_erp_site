<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\Business\Company\Domain\ValueObjects;

use Src\Utils\Validations\Types as Validate;

final class Id
{
    private $value;

    public function __construct(int $value)
    {
        $validate = new Validate;
        $validate->typeInteger($value);

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}