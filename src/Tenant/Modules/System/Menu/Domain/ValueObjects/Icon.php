<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\ValueObjects;

use Src\Tenant\Shared\Validations\Types as Validate;

final class Icon
{
    private $value;

    public function __construct(string $icon)
    {
        $validate = new Validate;
        $validate->typeString($icon);

        $this->value = $icon;
    }

    public function icon(): string
    {
        return $this->value;
    }
}