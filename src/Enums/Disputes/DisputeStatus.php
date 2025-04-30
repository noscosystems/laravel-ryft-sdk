<?php

namespace Nosco\Ryft\Enums\Disputes;

enum DisputeStatus: string
{
    case OPEN = 'Open';
    case CANCELLED = 'Cancelled';
    case ACCEPTED = 'Accepted';
    case CHALLENGED = 'Challenged';
    case LOST = 'Lost';
    case WON = 'Won';
    case EXPIRED = 'Expired';
}
