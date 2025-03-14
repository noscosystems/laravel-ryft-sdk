<?php

namespace Nosco\Ryft\Dtos;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Enums\DeviceChannel;

readonly class ThreeDsRequestDetails extends Dto
{
    public function __construct(
        public ?DeviceChannel $deviceChannel = null,
        public ?BrowserDetails $browserDetails = null,
    ) {}
}
