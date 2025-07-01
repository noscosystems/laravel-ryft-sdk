<?php

namespace Nosco\Ryft\Traits\Concerns;

use Nosco\Ryft\RyftConnector;

trait InteractsWithRyft
{
    public static function ryft(): RyftConnector
    {
        return new RyftConnector;
    }
}
