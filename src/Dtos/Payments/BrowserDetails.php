<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;

class BrowserDetails extends Dto
{
    public function __construct(
        public ?string $acceptHeader = null,
        public ?string $colorDepth = null,
        public ?string $javaEnabled = null,
        public ?string $language = null,
        public ?string $screenHeight = null,
        public ?string $screenWidth = null,
        public ?string $timeZoneOffset = null,
        public ?string $userAgent = null,
    ) {}
}
