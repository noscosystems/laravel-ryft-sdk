<?php

namespace Nosco\Ryft\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;

class InvalidAccount extends Exception
{
    /**
     * @param Model $owner
     */
    public static function notYetCreated(mixed $owner): static
    {
        return new static(class_basename($owner) . ' does not have an account yet.');
    }

    public static function malformedId(mixed $id): static
    {
        return new static("Malformed account ID: {$id}");
    }
}
