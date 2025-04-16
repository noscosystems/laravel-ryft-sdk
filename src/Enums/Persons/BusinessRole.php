<?php

namespace Nosco\Ryft\Enums\Persons;

enum BusinessRole: string
{
    case BUSINESS_CONTACT = 'BusinessContact';
    case DIRECTOR = 'Director';
    case ULTIMATE_BENEFICIAL_OWNER = 'UltimateBeneficialOwner';
}
