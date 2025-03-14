<?php

namespace Nosco\Ryft\Enums\Payments;

enum RequiredActionType: string
{
    case REDIRECT = 'Redirect';
    case IDENTIFY = 'Identify';
    case CHALLENGE = 'Challenge';
}
