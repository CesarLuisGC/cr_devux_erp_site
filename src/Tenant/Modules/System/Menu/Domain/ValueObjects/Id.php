<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\ValueObjects;

use Src\Tenant\Shared\Validations\Types as Validate;

final class Id
{
    private $value;

    public function __construct(int $id)
    {
        $validate = new Validate;
        $validate->typeInteger($id);

        $this->value = $id;
    }

    public function id(): int
    {
        return $this->value;
    }
}