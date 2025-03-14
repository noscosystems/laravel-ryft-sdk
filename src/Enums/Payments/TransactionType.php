<?php

namespace Nosco\Ryft\Enums\Payments;

enum TransactionType: string
{
    case AUTHORIZATION = 'Authorization';
    case VOID = 'Void';
    case CAPTURE = 'Capture';
    case REFUND = 'Refund';
    case CHARGEBACK = 'Chargeback';
    case CHARGEBACK_REVERSAL = 'ChargebackReversal';
}
