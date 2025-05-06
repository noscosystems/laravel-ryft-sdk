<?php

namespace Nosco\Ryft\Resource;

use Nosco\Ryft\Dtos\Accounts\AccountAuthorizationUrl;
use Nosco\Ryft\Requests\AccountLinks\AccountLinksCreate;
use Nosco\Ryft\Resource;

class AccountLinks extends Resource
{
    /**
     * Generate a new temporary account link.
     *
     * Generate a temporary account link to redirect the user to,
     * in order for them to complete registration and payout setup via our portal.
     *
     * @param string $accountId   The account id for which the payout verification is required
     * @param string $redirectUrl The URL to redirect back to on completion or cancellation of the verification detail
     *
     * @link https://api-reference.ryftpay.com/#tag/Account-Links/operation/accountLinksCreate Documentation
     */
    public function create(string $accountId, string $redirectUrl): AccountAuthorizationUrl
    {
        return $this->connector->send(new AccountLinksCreate($accountId, $redirectUrl))->dtoOrFail();
    }
}
