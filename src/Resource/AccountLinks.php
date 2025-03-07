<?php

namespace Nosco\Ryft\Resource;

use Nosco\Ryft\Requests\AccountLinks\AccountLinksCreate;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class AccountLinks extends Resource
{
    /**
     * Generate a new temporary account link.
     *
     * Generate a temporary account link to redirect the user to,
     * in order for them to complete registration and payout setup via our portal.
     *
     * @link https://api-reference.ryftpay.com/#tag/Account-Links/operation/accountLinksCreate Documentation
     */
    public function create(): Response
    {
        return $this->connector->send(new AccountLinksCreate);
    }
}
