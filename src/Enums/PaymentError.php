<?php

namespace Nosco\Ryft\Enums;

use Nosco\Ryft\Contracts\Enums\HasFallback;
use Nosco\Ryft\Contracts\Enums\HasLabel;

enum PaymentError: string implements HasFallback, HasLabel
{
    case INSUFFICIENT_FUNDS = 'insufficient_funds';
    case DECLINED_DO_NOT_HONOUR = 'declined_do_not_honour';
    case INVALID_CARD_NUMBER = 'invalid_card_number';
    case CVV2_FAILURE = 'cvv2_failure';
    case RESTRICTED_CARD = 'restricted_card';
    case BLACKLISTED_CARD = 'blacklisted_card';
    case BLACKLISTED_BIN = 'blacklisted_bin';
    case BLACKLISTED_COUNTRY = 'blacklisted_country';
    case BLACKLISTED_IP = 'blacklisted_ip';
    case RISK_DECLINED = 'risk_declined';
    case SECURITY_VIOLATION = 'security_violation';
    case EXPIRED_CARD = 'expired_card';
    case GATEWAY_REJECT = 'gateway_reject';
    case SUSPECTED_FRAUD = 'suspected_fraud';
    case CONTACT_ISSUER = 'contact_issuer';
    case NOT_PERMITTED = 'not_permitted';
    case INVALID_ACCOUNT = 'invalid_account';
    case PICKUP_CARD = 'pickup_card';
    case STOLEN_CARD = 'stolen_card';
    case ISSUER_DECLINE = 'issuer_decline';
    case CLOSED_ACCOUNT = 'closed_account';
    case ACCOUNT_NOT_ACTIVATED = 'account_not_activated';
    case LIMIT_EXCEEDED = 'limit_exceeded';
    case WITHDRAWAL_LIMIT_EXCEEDED = 'withdrawal_limit_exceeded';
    case AUTHENTICATION_FAILURE = '3ds_authentication_failure';
    case CARDHOLDER_NOT_PARTICIPATING = '3ds_cardholder_not_participating';
    case AUTHENTICATION_REQUIRED = '3ds_authentication_required';
    case AMEX_DISABLED = 'payment_method_option_amex_disabled';
    case ISSUER_ERROR = 'issuer_error';
    case SYSTEM_ERROR = 'system_error';
    case UNKNOWN_ERROR = 'unknown_error';

    /**
     * Reserved for new error codes that are not yet mapped to the SDK.
     */
    case NEW_UNMATCHED_ERROR = 'new_unmatched_error';

    public function label(): string
    {
        return str($this->value)
            ->swap([
                '_' => ' ',
                '3ds' => '3DS',
                'cvv' => 'CVV',
            ])
            ->title()
            ->toString();
    }

    public static function tryFromWithFallback(mixed $value): ?self
    {
        if ($case = self::tryFrom($value)) {
            return $case;
        }

        return $value ? self::fallback() : null;
    }

    public static function fallback(): HasFallback
    {
        return self::NEW_UNMATCHED_ERROR;
    }
}
