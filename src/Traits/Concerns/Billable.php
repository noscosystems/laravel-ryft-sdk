<?php

namespace Nosco\Ryft\Traits\Concerns;

trait Billable
{
    use ManagesCustomer;
    use ManagesPaymentMethods;
    use ManagesSubscriptions;
}
