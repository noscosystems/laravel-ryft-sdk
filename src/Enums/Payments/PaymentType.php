<?php

namespace Nosco\Ryft\Enums\Payments;

use Nosco\Ryft\Contracts\Enums\HasDefaultCase;

enum PaymentType: string implements HasDefaultCase
{
    /**
     * A regular one-off e-commerce payment, made by a customer on your website/app.
     */
    case STANDARD = 'Standard';

    /**
     * (subsequent) - Uses an already stored card on file for a fixed
     * or variable amount that does not occur on a scheduled or regular basis
     * such as recurring payments/subscriptions.
     */
    case UNSCHEDULED = 'Unscheduled';

    /**
     * @deprecated has now been deprecated in favour of the `entryMode` (`MOTO`) field.
     * @see EntryMode::MOTO
     */
    case MOTO = 'MOTO';
    case RECURRING = 'Recurring';

    public static function default(): self
    {
        return self::STANDARD;
    }
}
