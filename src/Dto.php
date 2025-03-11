<?php

namespace Nosco\Ryft;

use BackedEnum;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use JsonSerializable;
use Nosco\Ryft\Contracts\Enums\HasFallback;
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

        $data->transform(function (mixed $value, string $name) use ($reflection): mixed {
            if ($value === null) {
                return null;
            }

            $requiredType = $reflection->getProperty($name)->getType()?->getName();

            if (!is_subclass_of($value, Dto::class) && is_subclass_of($requiredType, Dto::class)) {
                return $requiredType::fromArray($value);
            }
            if (!$value instanceof BackedEnum && is_subclass_of($requiredType, BackedEnum::class)) {
                return is_subclass_of($requiredType, HasFallback::class)
                    ? $requiredType::tryFromWithFallback($value)
                    : $requiredType::tryFrom($value);
            }
            if (!$value instanceof DateTimeInterface && $requiredType === DateTimeInterface::class) {
                return static::dateTime($value);
            }
            if (!$value instanceof Collection && $requiredType === Collection::class) {
                return Collection::make($value);
            }

            return $value;
        });

        return $reflection->newInstanceArgs($data->all());
    }

    /**
     * @return Collection<static>
     */
    public static function multipleFromArray(Collection|array|null $data): Collection
    {
        return collect($data)
            ->map(fn (Collection|array|null $item): ?static => static::fromArray($item))
            ->filter();
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
