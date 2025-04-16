<?php

namespace Nosco\Ryft\Enums\Accounts;

enum BusinessType: string
{
    case CORPORATION = 'Corporation';
    case GOVERNMENT_ENTITY = 'GovernmentEntity';
    case CHARITY = 'Charity';
    case LIMITED_PARTNERSHIP = 'LimitedPartnership';
    case PRIVATE_COMPANY = 'PrivateCompany';
    case PUBLIC_COMPANY = 'PublicCompany';
}
