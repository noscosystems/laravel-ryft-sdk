<?php

namespace Nosco\Ryft\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;

class InvalidCustomer extends Exception
{
    /**
     * @param Model $owner
     */
    public static function notYetCreated(mixed $owner): static
    {
        return new static(class_basename($owner) . ' is not a Ryft customer yet.');
    }

    public static function malformedId(mixed $id): static
    {
        return new static("Malformed customer ID: {$id}");
    }
}
