<?php

namespace Nosco\Ryft\Support;

use BackedEnum;
use DateTimeInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Nosco\Ryft\Contracts\Enums\HasFallback;
use Nosco\Ryft\Dto;
use ReflectionNamedType;

class Cast
{
    public static function match(mixed $value, ReflectionNamedType $requiredType): mixed
    {
        if ($value === null) {
            return null;
        }
        if ($requiredType->isBuiltin()) {
            return $value;
        }

        $typeName = $requiredType->getName();

        return Cast::asDto($value, $typeName)
            ?? Cast::asEnum($value, $typeName)
            ?? Cast::asDateTime($value, $typeName)
            ?? Cast::asCollection($value, $typeName)
            ?? $value;
    }

    public static function asDto(mixed $value, string $dtoClass): ?Dto
    {
        if (
            is_subclass_of($value, Dto::class, false)
            || !is_subclass_of($dtoClass, Dto::class)
        ) {
            return null;
        }

        return $dtoClass::fromArray($value);
    }

    public static function asEnum(mixed $value, string $enumClass): ?BackedEnum
    {
        if ($value instanceof BackedEnum || !is_subclass_of($enumClass, BackedEnum::class)) {
            return null;
        }

        return is_subclass_of($enumClass, HasFallback::class)
            ? $enumClass::tryFromWithFallback($value)
            : $enumClass::tryFrom($value);
    }

    public static function asDateTime(mixed $value, string $dateTimeClass): ?DateTimeInterface
    {
        if (
            $value instanceof DateTimeInterface
            || $dateTimeClass !== DateTimeInterface::class
        ) {
            return null;
        }

        return Helpers::dateTime($value);
    }

    public static function asCollection(mixed $value, string $collectionClass): ?Collection
    {
        if (
            $value instanceof Arrayable
            || $collectionClass !== Collection::class
        ) {
            return null;
        }

        return Collection::make($value);
    }
}
