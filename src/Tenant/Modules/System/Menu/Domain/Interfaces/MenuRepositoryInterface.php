<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\Interfaces;

use Src\Tenant\Modules\System\Menu\Domain\Entities\SystMenu as Menu;
use Src\Tenant\Modules\System\Menu\Domain\ValueObjects\Id;

interface MenuRepositoryInterface
{
    public function getAll(): ?array;
}