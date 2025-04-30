<?php

namespace Nosco\Ryft\Enums\Subscriptions;

enum SubscriptionStatus: string
{
    case PENDING = 'Pending';
    case ACTIVE = 'Active';
    case CANCELLED = 'Cancelled';
    case PAST_DUE = 'PastDue';
    case ENDED = 'Ended';
    case PAUSED = 'Paused';
}
