<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\AvsResponseCode;
use Nosco\Ryft\Enums\CvvResponseCode;

readonly class CardChecks extends Dto
{
    public function __construct(
        public ?AvsResponseCode $avsResponseCode = null,
        public ?CvvResponseCode $cvvResponseCode = null,
    ) {}
}
