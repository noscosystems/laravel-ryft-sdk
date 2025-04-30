<?php

namespace Nosco\Ryft\Enums\Payouts;

enum PayoutScheme: string
{
    case ACH = 'Ach';
    case BACS = 'Bacs';
    case CHAPS = 'Chaps';
    case FPS = 'Fps';
    case SWIFT = 'Swift';
    case SEPA = 'Sepa';
    case SEPA_INSTANT = 'SepaInstant';
}
