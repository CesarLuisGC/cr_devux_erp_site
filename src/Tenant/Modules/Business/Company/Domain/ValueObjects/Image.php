<?php

declare(strict_types=1);

namespace Src\Tenant\Modules\Business\Company\Domain\ValueObjects;

use Src\Utils\Validations\Types as Validate;

final class Image
{
    private $value;

    public function __construct($value)
    {
        //$validate = new Validate;
        //$validate->typeString($value);
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }
}