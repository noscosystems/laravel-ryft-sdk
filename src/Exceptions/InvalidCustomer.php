<?php

namespace Nosco\Ryft\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Nosco\Ryft\Contracts\RyftCustomer;

class InvalidCustomer extends Exception
{
    /**
     * @param Model&RyftCustomer $owner
     */
    public static function notYetCreated(mixed $owner): static
    {
        return new static(class_basename($owner) . ' is not a Ryft customer yet.');
    }
}
