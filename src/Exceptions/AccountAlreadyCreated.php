<?php

namespace Nosco\Ryft\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Nosco\Ryft\Traits\Concerns\ManagesAccount;

class AccountAlreadyCreated extends Exception
{
    /**
     * @param Model|ManagesAccount $owner
     */
    public static function exists(mixed $owner): static
    {
        return new static(class_basename($owner) . " already has a Ryft account with ID: {$owner->ryftAccountId()}");
    }
}
