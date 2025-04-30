<?php

namespace Nosco\Ryft\Enums\PlatformFees;

enum PlatformFeeRefundStatus: string
{
    case PENDING = 'Pending';
    case FAILED = 'Failed';
    case SUCCEEDED = 'Succeeded';
}
