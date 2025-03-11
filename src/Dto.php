<?php

namespace Nosco\Ryft;

use BackedEnum;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use JsonSerializable;
use ReflectionClass;
use ReflectionException;

abstract readonly class Dto implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * @throws ReflectionException
     */
    public static function fromArray(Collection|array|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $reflection = new ReflectionClass(static::class);

        return $reflection->newInstanceArgs($data->all());
    }

    public function toArray(): array
    {
        return collect(get_object_vars($this))
            ->filter(fn (mixed $property) => $property !== null || $property !== [])
            ->map(function (mixed $property): mixed {
                if (is_array($property)) {
                    return collect($property);
                }
                if ($property instanceof BackedEnum) {
                    return $property->value;
                }

                return $property;
            })
            ->toArray();
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toJson($options = 0): false|string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    protected static function wrap(Collection|array|null $data): ?Collection
    {
        if ($data === null) {
            return null;
        }

        $data = collect($data)
            ->filter(fn (mixed $value): bool => $value !== null || $value !== []);

        return $data->isEmpty() ? null : $data;
    }

    protected static function dateTime(int|string|null $timestamp): ?DateTimeInterface
    {
        if ($timestamp === null) {
            return null;
        }

        return Carbon::parse($timestamp);
    }

    protected static function timestamp(?DateTimeInterface $date): ?int
    {
        return $date?->getTimestamp();

    }
}
