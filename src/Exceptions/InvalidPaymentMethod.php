<?php

namespace Nosco\Ryft\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;

class InvalidPaymentMethod extends Exception
{
    /**
     * @param Model $owner
     */
    public static function defaultNotSet(mixed $owner): static
    {
        return new static(class_basename($owner) . ' has no default payment method set.');
    }

    public static function idNotProvided(): static
    {
        return new static('No payment method ID provided.');
    }

    public static function malformedId(mixed $id): static
    {
        return new static("Malformed payment method ID: {$id}");
    }
}
