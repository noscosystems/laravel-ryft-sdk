<?php

namespace Nosco\Ryft\Enums\Payments;

enum CaptureType: string
{
    case FINAL = 'Final';
    case NON_FINAL = 'NonFinal';
}
