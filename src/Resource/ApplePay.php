<?php

namespace Nosco\Ryft\Resource;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\ApplePay\ApplePaySession;
use Nosco\Ryft\Dtos\ApplePay\ApplePayWebDomain;
use Nosco\Ryft\Requests\ApplePay\ApplePayCreateSession;
use Nosco\Ryft\Requests\ApplePay\ApplePayWebDomainDeleteById;
use Nosco\Ryft\Requests\ApplePay\ApplePayWebDomainGetById;
use Nosco\Ryft\Requests\ApplePay\ApplePayWebDomainRegister;
use Nosco\Ryft\Requests\ApplePay\ApplePayWebDomainsList;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class ApplePay extends Resource
{
    /**
     * List the web domains you have registered for Apple Pay.
     *
     * @param bool|null   $ascending   Control the order (newest or oldest) in which the payment sessions are returned.
     *                                 `false` will arrange the results with newest first,
     *                                 whereas `true` shows oldest first. The default is `false`.
     * @param int|null    $limit       Control how many items are return in a given page
     *                                 The max limit Ryft allow is `50`. The default is `20`.
     * @param string|null $startsAfter A token to identify where to resume a subsequent paginated query.
     *                                 The value of the `paginationToken` field from that response should be supplied here,
     *                                 to retrieve the next page of results for that timestamp range.
     *
     * @return Collection<ApplePayWebDomain>
     *
     * @link https://api-reference.ryftpay.com/#tag/Apple-Pay/operation/applePayWebDomainsList Documentation
     */
    public function listWebDomains(
        ?bool $ascending = null,
        ?int $limit = null,
        ?string $startsAfter = null
    ): Collection {
        return $this->connector
            ->send(new ApplePayWebDomainsList($ascending, $limit, $startsAfter))
            ->dtoOrFail();
    }

    /**
     * Register a domain for Apple Pay.
     *
     * Registers a domain name for Apple Pay on the web.
     * Note that this is required if relying on Ryft's Apple Pay processing certificate.
     *
     * A Maximum of 99 domains can be registered against a single Ryft account.
     *
     * Each domain must host Ryft's verification file under `/.well-known/apple-developer-merchantid-domain-association`.
     *
     * **Important**: the `Content-Type` of the hosted file must be `application/octet-stream`.
     *
     * @param string $domainName The domain name you want to register for Apple Pay.
     *
     * @link https://api-reference.ryftpay.com/#tag/Apple-Pay/operation/applePayWebDomainRegister Documentation
     */
    public function registerWebDomain(string $domainName): ApplePayWebDomain
    {
        return $this->connector
            ->send(new ApplePayWebDomainRegister($domainName))
            ->dtoOrFail();
    }

    /**
     * Retrieve an Apple Pay web domain.
     *
     * This is used to fetch an Apple Pay web domain by its unique ID
     *
     * @link https://api-reference.ryftpay.com/#tag/Apple-Pay/operation/applePayWebDomainGetById Documentation
     *
     * @param string $id Apple Pay web domain ID to retrieve
     */
    public function getWebDomain(string $id): ApplePayWebDomain
    {
        return $this->connector
            ->send(new ApplePayWebDomainGetById($id))
            ->dtoOrFail();
    }

    /**
     * Delete an Apple Pay web domain.
     *
     * This is used to delete an Apple Pay web domain by its unique ID
     *
     * @param string $id Apple Pay web domain ID to delete
     *
     * @link https://api-reference.ryftpay.com/#tag/Apple-Pay/operation/applePayWebDomainDeleteById Documentation
     */
    public function deleteWebDomain(string $id): ApplePayWebDomain
    {
        return $this->connector
            ->send(new ApplePayWebDomainDeleteById($id))
            ->dtoOrFail();
    }

    /**
     * Create an Apple Pay web session.
     *
     * Request a new Apple Pay web session. Use this endpoint if you process Apple Pay on the web and:
     *
     *  - you want to rely on Ryft's Apple Pay processing certificate
     *  - have an existing integration or want to implement Apple Pay via Ryft's API (without using Ryft's SDKs)
     *
     * @param string $displayName This is the name displayed within the Apple Pay payment sheet.
     *                            Must contain UTF-8 characters.
     * @param string $domainName  The domain name you have verified for Apple Pay (omit the protocol).
     *                            This should match `window.location.hostname`.
     *
     * @link https://api-reference.ryftpay.com/#tag/Apple-Pay/operation/applePayCreateSession Documentation
     */
    public function createSession(string $displayName, string $domainName): ApplePaySession
    {
        return $this->connector
            ->send(new ApplePayCreateSession($displayName, $domainName))
            ->dtoOrFail();
    }
}
