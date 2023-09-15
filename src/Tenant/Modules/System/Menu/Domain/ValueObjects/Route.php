<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\ValueObjects;

use Src\Tenant\Shared\Validations\Types as Validate;

final class Route
{
    private $value;

    public function __construct(string $route)
    {
        $validate = new Validate;
        $validate->typeString($route);

        $this->value = $route;
    }

    public function route(): string
    {
        return $this->value;
    }
}