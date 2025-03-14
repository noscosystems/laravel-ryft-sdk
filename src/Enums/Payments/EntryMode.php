<?php

namespace Nosco\Ryft\Enums\Payments;

enum EntryMode: string
{
    /**
     * When the payment method is collected with the customer present
     * (e.g. an e-commerce payment within a browser).
     */
    case ONLINE = 'Online';

    /**
     * when the payment method is collected via mail order (not e-email)
     * or over the phone.
     */
    case MOTO = 'MOTO';
}
