<?php

namespace Nosco\Ryft\Enums\Disputes;

enum DisputeCategory: string
{
    case FRAUDULENT = 'Fraudulent';
    case AUTHORIZATION = 'Authorization';
    case PROCESSING_ERROR = 'ProcessingError';
    case CARDHOLDER_DISPUTE = 'CardholderDispute';
    case GENERAL = 'General';
}
