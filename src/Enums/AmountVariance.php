<?php

namespace Nosco\Ryft\Enums;

use Nosco\Ryft\Contracts\Enums\HasDefaultCase;

enum AmountVariance: string implements HasDefaultCase
{
    case FIXED = 'Fixed';
    case VARIABLE = 'Variable';

    public static function default(): self
    {
        return self::FIXED;
    }
}
