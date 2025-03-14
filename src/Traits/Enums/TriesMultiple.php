<?php

namespace Nosco\Ryft\Traits\Enums;

use BackedEnum;
use Illuminate\Support\Collection;
use ValueError;

/**
 * @mixin BackedEnum
 */
trait TriesMultiple
{
    /**
     * @param string[]|int[]|Collection<string>|Collection<int> $values
     *
     * @return Collection<static>
     */
    public static function tryFromArray(array|Collection $values): Collection
    {
        return collect($values)
            ->map(
                fn (int|string|BackedEnum $value) => $value instanceof BackedEnum
                    ? $value
                    : static::tryFrom($value)
            )
            ->ensure(static::class);
    }

    /**
     * @param string[]|int[]|Collection<string>|Collection<int> $values
     *
     * @return Collection<static>
     *
     * @throws ValueError
     */
    public static function fromArray(array|Collection $values): Collection
    {
        return collect($values)
            ->map(
                fn (int|string|BackedEnum $value) => $value instanceof BackedEnum
                    ? $value
                    : static::from($value)
            )
            ->ensure(static::class);
    }
}
