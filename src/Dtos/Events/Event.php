<?php

namespace Nosco\Ryft\Dtos\Events;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\EventType;
use Nosco\Ryft\Support\Helpers;

readonly class Event extends Dto
{
    /**
     * @param Collection<EventEndpoint>|null $endpoints
     */
    public function __construct(
        public ?string $id = null,
        public ?EventType $eventType = null,
        public ?EventData $data = null,
        public ?Collection $endpoints = null,
        public ?string $accountId = null,
        public ?DateTimeInterface $createdTimestamp = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'endpoints' => EventEndpoint::multipleFromArray($data->get('endpoints', [])),
        ]);

        return parent::fromArray($data);
    }
}
