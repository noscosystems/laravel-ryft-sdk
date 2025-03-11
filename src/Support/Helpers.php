<?php

namespace Nosco\Ryft\Support;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Collection;

class Helpers
{
    public static function wrap(Collection|array|null $data): ?Collection
    {
        if ($data === null) {
            return null;
        }

        $data = collect($data)
            ->filter(fn (mixed $value): bool => $value !== null || $value !== []);

        return $data->isEmpty() ? null : $data;
    }

    public static function dateTime(int|string|null $timestamp): ?DateTimeInterface
    {
        if ($timestamp === null) {
            return null;
        }

        return Carbon::parse($timestamp);
    }

    public static function timestamp(?DateTimeInterface $date): ?int
    {
        return $date?->getTimestamp();
    }
}
