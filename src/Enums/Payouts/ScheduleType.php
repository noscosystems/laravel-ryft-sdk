<?php

namespace Nosco\Ryft\Enums\Payouts;

enum ScheduleType: string
{
    case AUTOMATIC = 'Automatic';
    case MANUAL = 'Manual';
}
