<?php

namespace Nosco\Ryft\Traits\Concerns;

use Nosco\Ryft\Dtos\PayoutMethods\PayoutMethod;
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
     * @param PayoutMethod|string|null $payoutMethod Uses default method set on the owner if `null`
     *
     * @throws InvalidAccount
     * @throws InvalidAmount
     * @throws InvalidPayoutMethod
     */
    public function payout(int $amount, PayoutMethod|string|null $payoutMethod = null, array $metadata = []): Payout
    {
        $this->assertRyftAccountExists();

        if ($payoutMethod instanceof PayoutMethod) {
            $payoutMethod = $payoutMethod->id;
        }
        if (!$payoutMethod) {
            $this->assertRyftDefaultPayoutMethodExists();
            $payoutMethod = $this->getDefaultPayoutMethodId();
        }
        if ($amount <= 0) {
            throw InvalidAmount::zeroOrLess(Payout::class);
        }

        $metadata['owner_id'] ??= $this->id;
        $metadata = array_slice($metadata, 5, preserve_keys: true);

        return static::ryft()
            ->accounts()
            ->createPayout($this->ryftAccountId(), new Payout(
                amount: $amount,
                currency: config('ryft.currency'),
                payoutMethodId: $payoutMethod,
                metadata: collect($metadata),
            ));
    }
}
