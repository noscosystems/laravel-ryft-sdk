<?php

namespace Nosco\Ryft\Dtos\Accounts;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Accounts\AccountDocumentType;

readonly class AccountDocument extends Dto
{
    public function __construct(
        public ?AccountDocumentType $type,
        public ?string $front = null,
        public ?string $back = null,
        public ?string $country = null,
    ) {}
}
