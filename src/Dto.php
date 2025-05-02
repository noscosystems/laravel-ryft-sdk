<?php

namespace Nosco\Ryft;

use BackedEnum;
use DateTimeInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use JsonException;
use JsonSerializable;
use Nosco\Ryft\Support\Cast;
use Nosco\Ryft\Support\Helpers;
use ReflectionClass;
use Saloon\Http\Response;

abstract class Dto implements Arrayable, Jsonable, JsonSerializable
{
    private ?Response $response = null;

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

    /**
     * @throws JsonException
     */
    public static function fromResponse(Response $response): ?static
    {
        if ($response->failed()) {
            return null;
        }

        return static::fromArray($response->json())->setResponse($response);
    }

    /**
     * @return Collection<static>
     *
     * @throws JsonException
     */
    public static function fromPaginatedResponse(Response $response, string $itemsKey = 'items'): Collection
    {
        if ($response->failed()) {
            return collect();
        }

        return static::multipleFromArray($response->json($itemsKey));
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
                if ($property instanceof DateTimeInterface) {
                    return Helpers::timestamp($property);
                }

                return $property;
            })
            ->filter()
            ->toArray();
    }

    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toJson($options = 0): false|string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function dd(): never
    {
        dd($this);
    }

    public function dump(): static
    {
        dump($this);

        return $this;
    }

    /**
     * Get the response instance that was used to create this DTO.
     */
    public function response(): ?Response
    {
        return $this->response;
    }

    protected function setResponse(Response $response): static
    {
        $this->response = $response;

        return $this;
    }
}
