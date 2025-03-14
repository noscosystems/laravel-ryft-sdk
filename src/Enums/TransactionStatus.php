<?php

namespace Nosco\Ryft\Enums;

enum TransactionStatus: string
{
    case PENDING = 'Pending';
    case FAILED = 'Failed';
    case SUCCEEDED = 'Succeeded';
}
