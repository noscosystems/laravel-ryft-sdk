<?php

namespace Nosco\Ryft\Exceptions;

use Exception;

class InvalidStatementDescriptor extends Exception
{
    public static function invalidPattern(?string $descriptor, string $pattern): static
    {
        return new static("\"{$descriptor}\" is not a valid statement descriptor. It must satisfy the pattern: {$pattern}");
    }
}
