<?php

namespace Nosco\Ryft;

use BackedEnum;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use JsonSerializable;
use Nosco\Ryft\Support\Cast;
use Nosco\Ryft\Support\Helpers;
use ReflectionClass;

abstract readonly class Dto implements Arrayable, Jsonable, JsonSerializable
{
    public static function fromArray(Collection|array|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $reflection = new ReflectionClass(static::class);

        return $data
            ->transform(function (mixed $value, string $name) use ($reflection): mixed {
                $requiredType = $reflection->getProperty($name)->getType();

                return Cast::match($value, $requiredType);
            })
            ->pipe(fn (Collection $params): ?Dto => $reflection->newInstanceArgs($data->all()));
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
}
