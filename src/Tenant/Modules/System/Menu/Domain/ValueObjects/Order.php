<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\System\Menu\Domain\ValueObjects;

use Src\Tenant\Shared\Validations\Types as Validate;

final class Order
{
    private $value;

    public function __construct(string $order)
    {
        $validate = new Validate;
        $validate->typeString($order);

        $this->value = $order;
    }

    public function order(): string
    {
        return $this->value;
    }
}