<?php

namespace Nosco\Ryft\Exceptions;

use Exception;

class InvalidAmount extends Exception
{
    /**
     * @param object|class-string $owner
     */
    public static function zeroOrLess(mixed $owner): static
    {
        return new static(class_basename($owner) . ' amount must be greater than zero');
    }
}
