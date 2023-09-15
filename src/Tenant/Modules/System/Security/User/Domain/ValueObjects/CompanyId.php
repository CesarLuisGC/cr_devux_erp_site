<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Security\User\Domain\ValueObjects;

use Src\Utils\Validations\Types as Validate;

final class CompanyId
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