<?php

namespace Nosco\Ryft\Enums\PayoutMethods;

enum BankIdType: string
{
    case ROUTING_NUMBER = 'RoutingNumber';
    case SORT_CODE = 'SortCode';
}
