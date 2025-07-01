<?php

namespace Nosco\Ryft\Traits\Concerns;

use Illuminate\Database\Eloquent\Model;
use LogicException;
use Nosco\Ryft\Dtos\Accounts\Account;
use Nosco\Ryft\Dtos\Accounts\AccountAuthorizationUrl;
use Nosco\Ryft\Exceptions\AccountAlreadyCreated;
use Nosco\Ryft\Exceptions\InvalidAccount;

/**
 * @mixin Model
 */
trait ManagesAccount
{
    use InteractsWithAccount;
    use InteractsWithRyft;

    /**
     * @throws AccountAlreadyCreated
     * @throws LogicException
     */
    public function createAsRyftAccount(Account $account, array $metadata = []): Account
    {
        $this->assertRyftAccountDoesNotExist();

        if ($account->metadata === null) {
            $account->metadata = collect();
        }

        $account->metadata = $account->metadata
            ->merge($this->ryftAccountMetadata())
            ->merge($metadata)
            ->take(5);

        $account = static::ryft()->accounts()->create($account);

        $this->updateAccountFromRyft($account);

        return $account;
    }

    /**
     * @throws InvalidAccount
     * @throws LogicException
     */
    public function updateRyftAccount(Account $account): Account
    {
        $this->assertRyftAccountExists();

        $account->id = null;

        $account = static::ryft()
            ->accounts()
            ->update($this->ryftAccountId(), $account);

        $this->updateAccountFromRyft($account);

        return $account;
    }

    protected function updateAccountFromRyft(Account $account): void
    {
        $this
            ->forceFill([
                'ryft_account_id' => $account->id,
                'ryft_account_type' => $account->type->value,
            ])
            ->save();
    }

    /**
     * Creates a link at which the user can sign in to their existing Ryft account
     * to authorize with your platform.
     *
     * @param ?string $email The user's email address to link with Ryft.
     *                       Defaults to the email address of the model `email`.
     *
     * @throws AccountAlreadyCreated
     */
    public function linkRyftAccount(string $redirectUrl, ?string $email = null): AccountAuthorizationUrl
    {
        $this->assertRyftAccountDoesNotExist();

        return static::ryft()->accounts()->authorize(
            email: $email ?? $this->email ?? '',
            redirectUrl: $redirectUrl,
        );
    }
}
