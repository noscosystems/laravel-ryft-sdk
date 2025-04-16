<?php

namespace Nosco\Ryft\Enums\Accounts;

use Illuminate\Support\Collection;
use Nosco\Ryft\Traits\Enums\TriesMultiple;

enum AccountDocumentType: string
{
    use TriesMultiple;

    case BANK_STATEMENT = 'BankStatement';
    case BUSINESS_REGISTRATION = 'BusinessRegistration';
    case CREDIT_CARD_STATEMENT = 'CreditCardStatement';
    case DRIVERS_LICENSE = 'DriversLicense';
    case LETTER_OF_AUTHORIZATION = 'LetterOfAuthorization';
    case NATIONAL_ID = 'NationalId';
    case OFFICIAL_GOVERNMENT_LETTER = 'OfficialGovernmentLetter';
    case PASSPORT = 'Passport';
    case PROPERTY_TAX_ASSESSMENT = 'PropertyTaxAssessment';
    case TAX_RETURN = 'TaxReturn';
    case UTILITY_BILL = 'UtilityBill';

    public static function authorization(): Collection
    {
        return collect([
            self::LETTER_OF_AUTHORIZATION,
        ]);
    }

    public static function proofOfAddress(): Collection
    {
        return collect([
            self::BANK_STATEMENT,
            self::CREDIT_CARD_STATEMENT,
            self::OFFICIAL_GOVERNMENT_LETTER,
            self::PROPERTY_TAX_ASSESSMENT,
            self::TAX_RETURN,
            self::UTILITY_BILL,
        ]);
    }

    public static function proofOfBusiness(): Collection
    {
        return collect([
            self::BUSINESS_REGISTRATION,
        ]);
    }

    public static function proofOfIdentity(): Collection
    {
        return collect([
            self::DRIVERS_LICENSE,
            self::NATIONAL_ID,
            self::PASSPORT,
        ]);
    }
}
