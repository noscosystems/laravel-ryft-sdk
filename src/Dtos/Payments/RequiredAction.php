<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\RequiredActionType;

readonly class RequiredAction extends Dto
{
    public function __construct(
        public ?RequiredActionType $type = null,
        public ?string $url = null,
        public ?RequiredActionIdentify $identify = null,
    ) {}
}
