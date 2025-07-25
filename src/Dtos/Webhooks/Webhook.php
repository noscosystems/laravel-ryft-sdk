<?php

namespace Nosco\Ryft\Dtos\Webhooks;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\EventType;
use Nosco\Ryft\Support\Helpers;

class Webhook extends Dto
{
    /**
     * @param Collection<>|null $eventTypes
     */
    public function __construct(
        public ?string $id = null,
        public ?string $secret = null,
        public ?string $url = null,
        public ?bool $active = null,
        public ?Collection $eventTypes = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'eventTypes' => EventType::tryFromArray($data->get('eventTypes', []))->filter(),
        ]);

        return parent::fromArray($data);
    }
}
