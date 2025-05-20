<?php

namespace Nosco\Ryft\Exceptions;

use Exception;

class InvalidPayoutMethod extends Exception
{
    public static function defaultNotSet(mixed $owner): static
    {
        return new static(class_basename($owner) . ' has no default payout method set.');
    }
}
