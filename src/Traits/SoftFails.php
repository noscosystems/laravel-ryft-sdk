<?php

namespace Nosco\Ryft\Traits;

use InvalidArgumentException;
use Saloon\Exceptions\SaloonException;
use Throwable;

trait SoftFails
{
    /**
     * @template T of Throwable
     *
     * @param T    $throwable
     * @param bool $throwOthers Throw non-Saloon exceptions when `true`
     *
     * @throws T Any non-Saloon exceptions
     */
    protected function reportSaloonExceptions(mixed $throwable, bool $throwOthers = true): void
    {
        if (!$throwable instanceof Throwable) {
            throw new InvalidArgumentException($throwable::class . ' must be an instance of Throwable.');
        }
        if ($throwable instanceof SaloonException) {
            report($throwable);
        }
        if ($throwable->getPrevious() instanceof SaloonException) {
            report($throwable->getPrevious());
        }
        if ($throwOthers) {
            throw $throwable;
        }
    }
}
