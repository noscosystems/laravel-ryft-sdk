<?php

namespace Nosco\Ryft\Dtos\Transfers;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\Accounts\Account;
use Nosco\Ryft\Enums\Transfers\TransferStatus;
use Nosco\Ryft\Support\Helpers;

class Transfer extends Dto
{
    /**
     * @param Collection<TransferError>|null $errors
     */
    public function __construct(
        public ?string $id = null,
        public ?TransferStatus $status = null,
        public ?int $amount = null,
        public ?string $currency = null,
        public ?Account $source = null,
        public ?Account $destination = null,
        public ?string $reason = null,
        public ?Collection $metadata = null,
        public ?Collection $errors = null,
        public ?DateTimeInterface $createdTimestamp = null,
        public ?DateTimeInterface $lastUpdatedTimestamp = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = Helpers::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'errors' => TransferError::multipleFromArray($data->get('errors', [])),
        ]);

        return parent::fromArray($data);
    }
}
