<?php

namespace Nosco\Ryft\Enums;

enum RequiredActionType: string
{
    case REDIRECT = 'Redirect';
    case IDENTIFY = 'Identify';
    case CHALLENGE = 'Challenge';
}
