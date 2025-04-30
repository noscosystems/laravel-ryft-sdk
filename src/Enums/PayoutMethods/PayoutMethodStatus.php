<?php

namespace Nosco\Ryft\Enums\PayoutMethods;

enum PayoutMethodStatus: string
{
    case PENDING = 'Pending';
    case INVALID = 'Invalid';
    case VALID = 'Valid';
}
