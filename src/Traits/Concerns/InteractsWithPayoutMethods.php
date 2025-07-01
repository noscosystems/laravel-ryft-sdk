<?php

namespace Nosco\Ryft\Traits\Concerns;

use Nosco\Ryft\Dtos\PayoutMethods\PayoutMethod;
use Nosco\Ryft\Exceptions\InvalidPayoutMethod;

trait InteractsWithPayoutMethods
{
    use InteractsWithAccount;
    use InteractsWithRyft;
    public function findPayoutMethod(string $id): PayoutMethod
    {
        return static::ryft()->payoutMethods()->get($this->ryftAccountId(), $id);
    }

    public function defaultPayoutMethodId(): ?string
    {
        return $this->ryft_payout_method_id ?? null;
    }

    /**
     * @throws InvalidPayoutMethod
     */
    protected function assertRyftDefaultPayoutMethodExists(): void
    {
        if (!$this->defaultPayoutMethodId()) {
            throw InvalidPayoutMethod::defaultNotSet($this);
        }
    }

    /**
     * @throws InvalidPayoutMethod
     */
    public function getDefaultPayoutMethod(): PayoutMethod
    {
        $this->assertRyftDefaultPayoutMethodExists();

        return $this->findPayoutMethod($this->defaultPayoutMethodId());
    }
}
