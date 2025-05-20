<?php

namespace Nosco\Ryft\Traits\Concerns;

use Nosco\Ryft\Dtos\PayoutMethods\BankAccount;
use Nosco\Ryft\Dtos\PayoutMethods\PayoutMethod;
use Nosco\Ryft\Enums\PayoutMethods\PayoutMethodType;
use Nosco\Ryft\Exceptions\InvalidAccount;
use Nosco\Ryft\Requests\PayoutMethods\PayoutMethodsList;
use Saloon\PaginationPlugin\Paginator;

trait ManagesPayoutMethods
{
    use InteractsWithAccount;
    use InteractsWithRyft;

    /**
     * @throws InvalidAccount
     */
    public function payoutMethods(): Paginator
    {
        $this->assertRyftAccountExists();

        return static::ryft()->paginate(new PayoutMethodsList(
            id: $this->ryftAccountId()
        ));
    }

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
        string $payoutMethod,
        ?string $name = null,
        ?BankAccount $bankAccount = null,
    ): PayoutMethod {
        $this->assertRyftAccountExists();

        if (!str($payoutMethod)->isMatch('/^ac_[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/')) {
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
