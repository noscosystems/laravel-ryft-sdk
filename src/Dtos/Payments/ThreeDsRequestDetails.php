<?php

namespace Nosco\Ryft\Dtos\Payments;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\Payments\DeviceChannel;

readonly class ThreeDsRequestDetails extends Dto
{
    public function __construct(
        public ?DeviceChannel $deviceChannel = null,
        public ?BrowserDetails $browserDetails = null,
    ) {}
}
