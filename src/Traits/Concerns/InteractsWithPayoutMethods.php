<?php

namespace Nosco\Ryft\Traits\Concerns;

use Nosco\Ryft\Dtos\PayoutMethods\PayoutMethod;
use Nosco\Ryft\Exceptions\InvalidPayoutMethod;

trait InteractsWithPayoutMethods
{
    use InteractsWithAccount;
    use InteractsWithRyft;
    public function getPayoutMethod(string $id): PayoutMethod
    {
        return static::ryft()->payoutMethods()->get($this->ryftAccountId(), $id);
    }

    public function getDefaultPayoutMethodId(): ?string
    {
        return $this->ryft_payout_method_id;
    }

    /**
     * @throws InvalidPayoutMethod
     */
    protected function assertRyftDefaultPayoutMethodExists(): void
    {
        if (!$this->getDefaultPayoutMethodId()) {
            throw InvalidPayoutMethod::defaultNotSet($this);
        }
    }

    /**
     * @throws InvalidPayoutMethod
     */
    public function getDefaultPayoutMethod(): PayoutMethod
    {
        $this->assertRyftDefaultPayoutMethodExists();

        return $this->getPayoutMethod($this->getDefaultPayoutMethodId());
    }
}
