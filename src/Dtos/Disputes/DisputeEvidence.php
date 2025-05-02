<?php

namespace Nosco\Ryft\Dtos\Disputes;

use Nosco\Ryft\Dto;

class DisputeEvidence extends Dto
{
    public function __construct(
        public ?TextEntries $text = null,
        public ?Files $files = null,
    ) {}
}
