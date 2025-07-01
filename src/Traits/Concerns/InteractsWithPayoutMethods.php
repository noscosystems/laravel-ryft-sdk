<?php

namespace Nosco\Ryft\Traits\Concerns;

use LogicException;
use Nosco\Ryft\Dtos\PayoutMethods\PayoutMethod;
use Nosco\Ryft\Exceptions\InvalidPayoutMethod;
use Nosco\Ryft\Traits\SoftFails;

trait InteractsWithPayoutMethods
{
    use InteractsWithAccount;
    use InteractsWithRyft;
    use SoftFails;
    public function findPayoutMethod(string $id): ?PayoutMethod
    {
        try {
            return static::ryft()->payoutMethods()->get($this->ryftAccountId(), $id);
        } catch (LogicException $e) {
            $this->reportSaloonExceptions($e);

            return null;
        }
    }

    public function defaultPayoutMethodId(): ?string
    {
        return $this->ryft_payout_method_id ?? null;
    }

    public function hasDefaultPayoutMethod(): bool
    {
        return !empty($this->defaultPayoutMethodId());
    }

    /**
     * @throws InvalidPayoutMethod
     */
    protected function assertRyftDefaultPayoutMethodExists(): void
    {
        if (!$this->hasDefaultPayoutMethod()) {
            throw InvalidPayoutMethod::defaultNotSet($this);
        }
    }

    /**
     * @throws InvalidPayoutMethod
     */
    public function defaultPayoutMethod(): PayoutMethod
    {
        $this->assertRyftDefaultPayoutMethodExists();

        return $this->findPayoutMethod($this->defaultPayoutMethodId());
    }
}
