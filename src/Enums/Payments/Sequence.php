<?php

namespace Nosco\Ryft\Enums\Payments;

enum Sequence: string
{
    case INITIAL = 'Initial';
    case SUBSEQUENT = 'Subsequent';
}
