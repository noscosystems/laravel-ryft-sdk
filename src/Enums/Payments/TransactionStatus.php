<?php

namespace Nosco\Ryft\Enums\Payments;

enum TransactionStatus: string
{
    case PENDING = 'Pending';
    case FAILED = 'Failed';
    case SUCCEEDED = 'Succeeded';
}
