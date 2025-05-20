<?php

namespace Nosco\Ryft\Traits\Concerns;

use Nosco\Ryft\Dtos\PayoutMethods\BankAccount;
use Nosco\Ryft\Dtos\PayoutMethods\PayoutMethod;
use Nosco\Ryft\Enums\PayoutMethods\PayoutMethodType;
use Nosco\Ryft\Exceptions\InvalidAccount;

trait ManagesPayoutMethods
{
    use InteractsWithAccount;
    use InteractsWithRyft;

    /**
     * @throws InvalidAccount
     */
    public function createPayoutMethod(string $name, BankAccount $bankAccount): PayoutMethod
    {
        $this->assertRyftAccountExists();

        return static::ryft()
            ->payoutMethods()
            ->create($this->ryftAccountId(), new PayoutMethod(
                type: PayoutMethodType::BANK_ACCOUNT,
                displayName: $name,
                currency: $this->payoutCurrency(),
                country: $this->payoutCountry(),
                bankAccount: $bankAccount,
            ));
    }

    /**
     * @throws InvalidAccount
     */
    public function updatePayoutMethod(
        PayoutMethod|string $payoutMethod,
        ?string $name = null,
        ?BankAccount $bankAccount = null,
    ): PayoutMethod {
        $this->assertRyftAccountExists();

        if ($payoutMethod instanceof PayoutMethod) {
            $payoutMethod = $payoutMethod->id;
        }
        if (!$payoutMethod) {
            throw InvalidAccount::malformedId($this);
        }

        return static::ryft()
            ->payoutMethods()
            ->update($this->ryftAccountId(), $payoutMethod, new PayoutMethod(
                displayName: $name,
                bankAccount: $bankAccount,
            ));
    }

    protected function payoutCountry(): string
    {
        return config('ryft.country');
    }

    protected function payoutCurrency(): string
    {
        return config('ryft.currency');
    }
}
