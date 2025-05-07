<?php

namespace Nosco\Ryft\Exceptions;

use Exception;

class ContractNotImplemented extends Exception
{
    public static function ryftCustomer(mixed $owner): static
    {
        return new static(class_basename($owner) . ' must implement RyftCustomer contract');
    }
}
