<?php

namespace Nosco\Ryft\Enums\Transfers;

enum TransferStatus: string
{
    case PENDING = 'Pending';
    case DECLINED = 'Declined';
    case COMPLETED = 'Completed';
}
