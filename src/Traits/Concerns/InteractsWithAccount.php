<?php

namespace Nosco\Ryft\Traits\Concerns;

use LogicException;
use Nosco\Ryft\Dtos\Accounts\Account;
use Nosco\Ryft\Enums\Accounts\AccountType;
use Nosco\Ryft\Exceptions\AccountAlreadyCreated;
use Nosco\Ryft\Exceptions\InvalidAccount;

trait InteractsWithAccount
{
    public function ryftAccountId(): ?string
    {
        return $this->ryft_account_id ?? null;
    }

    public function hasRyftAccount(): bool
    {
        return $this->ryftAccountId() !== null;
    }

    /**
     * @throws InvalidAccount
     */
    public function ryftAccountType(): ?AccountType
    {
        $this->assertRyftAccountExists();

        return AccountType::tryFrom($this->ryft_account_type ?? '');
    }

    /**
     * @throws InvalidAccount
     * @throws LogicException
     */
    public function asRyftAccount(): Account
    {
        $this->assertRyftAccountExists();

        return static::ryft()->accounts()->get($this->ryftAccountId());
    }

    protected function ryftAccountMetadata(): array
    {
        return [
            'owner_id' => $this->id ?? null,
        ];
    }

    /**
     * @throws InvalidAccount
     */
    protected function assertRyftAccountExists(): void
    {
        if (!$this->hasRyftAccount()) {
            throw InvalidAccount::notYetCreated($this);
        }
        if (
            !str($this->ryftAccountId())
                ->isMatch('/^ac_[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/')
        ) {
            throw InvalidAccount::malformedId($this->ryftAccountId());
        }
    }

    /**
     * @throws AccountAlreadyCreated
     */
    protected function assertRyftAccountDoesNotExist(): void
    {
        if ($this->ryftAccountId()) {
            throw AccountAlreadyCreated::exists($this);
        }
    }
}
