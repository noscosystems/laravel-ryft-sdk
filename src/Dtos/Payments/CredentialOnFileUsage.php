<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Initiator;
use Nosco\Ryft\Enums\Sequence;

readonly class CredentialOnFileUsage extends Dto
{
    public function __construct(
        public ?Initiator $initiator = null,
        public ?Sequence $sequence = null,
    ) {}
}
