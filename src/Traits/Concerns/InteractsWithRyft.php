<?php

namespace Nosco\Ryft\Traits\Concerns;

use Nosco\Ryft\Ryft;

trait InteractsWithRyft
{
    public static function ryft(): Ryft
    {
        return new Ryft;
    }
}
