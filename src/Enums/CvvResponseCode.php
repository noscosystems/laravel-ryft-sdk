<?php

namespace Nosco\Ryft\Enums;

use Nosco\Ryft\Contracts\Enums\HasLabel;

enum CvvResponseCode: string implements HasLabel
{
    case MATCH = 'M';
    case MATCH_AMEX = 'Y';
    case NO_MATCH = 'N';
    case NOT_PROCESSED = 'P';
    case SHOULD_BE_PRESENT = 'S';
    case NOT_PROVIDED = 'U';

    public function label(): string
    {
        return match ($this) {
            self::MATCH => 'Match (Visa/Mastercard)',
            self::MATCH_AMEX => 'Match (American Express)',
            self::NO_MATCH => 'No Match',
            self::NOT_PROCESSED => 'Not Processed',
            self::SHOULD_BE_PRESENT => 'Should be on card',
            self::NOT_PROVIDED => 'Issuer does not participate',
        };
    }
}
