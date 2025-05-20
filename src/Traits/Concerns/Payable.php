<?php

namespace Nosco\Ryft\Traits\Concerns;

trait Payable
{
    use ManagesAccount;
    use ManagesPayoutMethods;
    use PerformsPayouts;
}
