<?php

namespace Nosco\Ryft\Dtos;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dto;

readonly class PaymentMethod extends Dto
{
    public function __construct(
        public ?string $id = null,
        public ?string $cvc = null,
        public ?string $type = null,
        public ?TokenizedDetails $tokenizedDetails = null,
        public ?Card $card = null,
        public ?Wallet $wallet = null,
        public ?CustomerAddress $billingAddress = null,
        public ?CardChecks $checks = null,
    ) {}

    public static function fromArray(array|Collection|null $data): ?static
    {
        if (!$data = static::wrap($data)) {
            return null;
        }

        $data = $data->merge([
            'tokenizedDetails' => TokenizedDetails::fromArray($data->get('tokenizedDetails')),
            'card' => Card::fromArray($data->get('card')),
            'wallet' => Wallet::fromArray($data->get('wallet')),
            'billingAddress' => CustomerAddress::fromArray($data->get('billingAddress')),
            'checks' => CardChecks::fromArray($data->get('checks')),
        ]);

        return parent::fromArray($data);
    }
}
