<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\ValueObjects;

use Src\Tenant\Shared\Validations\Types as Validate;

final class MenuParent
{
    private $value;

    public function __construct(string $parent)
    {
        $validate = new Validate;
        $validate->typeString($parent);

        $this->value = $parent;
    }

    public function parent(): string
    {
        return $this->value;
    }
}