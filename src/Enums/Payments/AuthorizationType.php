<?php

namespace Nosco\Ryft\Enums\Payments;

enum AuthorizationType: string
{
    case PRE_AUTHORIZATION = 'PreAuth';
    case FINAL_AUTHORIZATION = 'FinalAuth';
}
