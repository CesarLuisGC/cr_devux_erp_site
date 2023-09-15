<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\ValueObjects;

use Src\Tenant\Shared\Validations\Types as Validate;

final class Name
{
    private $value;

    public function __construct(string $name)
    {
        $validate = new Validate;
        $validate->typeString($name);

        $this->value = $name;
    }

    public function name(): string
    {
        return $this->value;
    }
}