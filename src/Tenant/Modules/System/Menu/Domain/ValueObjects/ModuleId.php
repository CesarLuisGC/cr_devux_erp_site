<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\ValueObjects;

use Src\Tenant\Shared\Validations\Types as Validate;

final class ModuleId
{
    private $value;

    public function __construct(int $moduleid)
    {
        $validate = new Validate;
        $validate->typeInteger($moduleid);

        $this->value = $moduleid;
    }

    public function moduleId(): int
    {
        return $this->value;
    }
}