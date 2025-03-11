<?php

namespace Nosco\Ryft\Contracts\Enums;

interface HasFallback
{
    public static function tryFromWithFallback(mixed $value): ?self;

    public static function fallback(): self;
}
