<?php

namespace Nosco\Ryft\Exceptions;

use Exception;

class InvalidAttribute extends Exception
{
    /**
     * @param object|class-string $owner
     */
    public static function notExists(mixed $owner, string $attribute): static
    {
        return new static(class_basename($owner) . " does not have an attribute: {$attribute}");
    }
}
