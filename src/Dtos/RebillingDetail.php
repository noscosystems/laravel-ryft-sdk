<?php

namespace Nosco\Ryft\Dtos;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

readonly class RebillingDetail extends Dto
{
    public function __construct(
        public ?string $amountVariance = null,
        public ?int $numberOfDaysBetweenPayments = null,
        public ?int $totalNumberOfPayments = null,
        public ?int $currentPaymentNumber = null,
        public ?DateTimeInterface $expiry = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'expiry' => static::dateTime($data->get('expiry')),
        ]);

        return parent::fromArray($data);
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $properties['expiry'] = $this->expiry?->getTimestamp();

        return array_filter($properties);
    }
}
