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
        public Dto|Collection|null $data = null,
        public ?Collection $endpoints = null,
        public ?string $accountId = null,
        public ?DateTimeInterface $createdTimestamp = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $event = parent::fromArray($data->merge([
            'data' => collect($data->get('data', [])),
            'endpoints' => EventEndpoint::multipleFromArray($data->get('endpoints', [])),
        ]));

        $detailsClass = $event->eventType?->dtoClass();

        if ($detailsClass && is_subclass_of($detailsClass, Dto::class)) {
            $event->data = $detailsClass::fromArray($event->data);
        }

        return $event;
    }
}
