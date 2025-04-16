<?php

namespace Nosco\Ryft\Enums\Accounts;

enum AccountOnboardingFlow: string
{
    case HOSTED = 'Hosted';
    case NON_HOSTED = 'NonHosted';
}
