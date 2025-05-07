<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Saloon\Http\Response;
use Stringable;

class Error extends Dto implements Stringable
{
    public function __construct(
        public ?string $code = null,
        public ?string $message = null,
    ) {}

    public function __toString(): string
    {
        return $this->message ?? '';
    }

    public static function fromPaginatedResponse(Response $response, string $itemsKey = 'errors'): Collection
    {
        return static::multipleFromArray($response->json($itemsKey));
    }
}
