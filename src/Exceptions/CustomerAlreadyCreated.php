<?php

namespace Nosco\Ryft\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Nosco\Ryft\Traits\Concerns\InteractsWithCustomer;

class CustomerAlreadyCreated extends Exception
{
    /**
     * @param Model&InteractsWithCustomer $owner
     */
    public static function exists(mixed $owner): static
    {
        return new static(class_basename($owner) . " is already a Ryft customer with ID: {$owner->ryftId()}");
    }
}
