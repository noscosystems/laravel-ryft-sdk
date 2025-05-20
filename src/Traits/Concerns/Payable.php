<?php

namespace Nosco\Ryft\Traits;

use Nosco\Ryft\Traits\Concerns\ManagesAccount;
use Nosco\Ryft\Traits\Concerns\ManagesPayoutMethods;
use Nosco\Ryft\Traits\Concerns\PerformsPayouts;

trait Payable
{
    use ManagesAccount;
    use ManagesPayoutMethods;
    use PerformsPayouts;
}
