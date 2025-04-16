<?php

namespace Nosco\Ryft\Enums\Accounts;

enum VerificationErrorCode: string
{
    case INVALID_DOCUMENT = 'InvalidDocument';
    case INVALID_FIELD = 'InvalidField';
}
