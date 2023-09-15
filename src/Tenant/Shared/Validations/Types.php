<?php

namespace Src\Tenant\Shared\Validations;

use InvalidArgumentException;

final class Types
{
    /**
     * @param string $value
     * @throws InvalidArgumentException
     */
    public function typeString(string $value): void
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException(
                sprintf('<%s> no es un valor aceptado, favor valide <%s>.', static::class, $value)
            );
        }
    }

    /**
     * @param int $number
     * @throws InvalidArgumentException
     */
    public function typeInteger(int $number): void
    {
        if (!is_int($number)) {
            throw new InvalidArgumentException(
                sprintf('<%s> No es un valor entero <%s>.', static::class, $number)
            );
        }
    }

    /**
     * @param bool $value
     * @throws InvalidArgumentException
     */
    public function typeBoolean(bool $value): void
    {
        if (!is_bool($value)) {
            throw new InvalidArgumentException(
                sprintf('<%s> no es un valor BOOLEAN <%s>.', static::class, $value)
            );
        }
    }
}