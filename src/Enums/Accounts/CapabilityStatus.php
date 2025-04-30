<?php

namespace Nosco\Ryft\Enums\Accounts;

enum CapabilityStatus: string
{
    case NOT_REQUESTED = 'NotRequested';
    case PENDING = 'Pending';
    case DISABLED = 'Disabled';
    case ENABLED = 'Enabled';
}
