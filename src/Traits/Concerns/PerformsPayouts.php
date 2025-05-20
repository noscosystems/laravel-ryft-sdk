<?php

namespace Nosco\Ryft\Traits\Concerns;

use Nosco\Ryft\Dtos\Payouts\Payout;
use Nosco\Ryft\Exceptions\InvalidAccount;
use Nosco\Ryft\Exceptions\InvalidAmount;
use Nosco\Ryft\Exceptions\InvalidPayoutMethod;

trait PerformsPayouts
{
    use InteractsWithAccount;
    use InteractsWithPayoutMethods;
    use InteractsWithRyft;

    /**
     * Creates a manual payout for the this account.
     *
     * @param ?string $payoutMethod Uses default method set on the owner if `null`
     *
     * @throws InvalidAccount
     * @throws InvalidAmount
     * @throws InvalidPayoutMethod
     */
    public function payout(int $amount, ?string $payoutMethod = null, array $metadata = []): Payout
    {
        $this->assertRyftAccountExists();

        if (str($payoutMethod)->isEmpty()) {
            $this->assertRyftDefaultPayoutMethodExists();
            $payoutMethod = $this->getDefaultPayoutMethodId();
        }
        if ($amount <= 0) {
            throw InvalidAmount::zeroOrLess(Payout::class);
        }

        $metadata = collect($this->ryftAccountMetadata())
            ->merge($metadata)
            ->take(5);

        return static::ryft()
            ->accounts()
            ->createPayout($this->ryftAccountId(), new Payout(
                amount: $amount,
                currency: config('ryft.currency'),
                payoutMethodId: $payoutMethod,
                metadata: $metadata,
            ));
    }
}
