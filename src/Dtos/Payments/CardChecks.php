<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Payments\AvsResponseCode;
use Nosco\Ryft\Enums\Payments\CvvResponseCode;

readonly class CardChecks extends Dto
{
    public function __construct(
        public ?AvsResponseCode $avsResponseCode = null,
        public ?CvvResponseCode $cvvResponseCode = null,
    ) {}
}
