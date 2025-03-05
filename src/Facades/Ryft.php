<?php

namespace Nosco\Ryft\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nosco\Ryft\Ryft
 */
class Ryft extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Nosco\Ryft\Ryft::class;
    }
}
