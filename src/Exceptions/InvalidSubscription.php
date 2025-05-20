<?php

namespace Nosco\Ryft\Exceptions;

use Exception;

class InvalidSubscription extends Exception
{
    public static function malformedId(mixed $id): static
    {
        return new static("Malformed subscription ID: {$id}");
    }

    public static function noBillingAddress(): static
    {
        return new static('Subscription requires a billing address.');
    }
}
