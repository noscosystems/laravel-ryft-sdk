<?php

namespace Nosco\Ryft\Enums\Payments;

enum CaptureFlow: string
{
    case AUTOMATIC = 'Automatic';
    case MANUAL = 'Manual';
}
