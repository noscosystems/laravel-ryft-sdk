<?php

namespace Nosco\Ryft\Requests\ApplePay;

use Nosco\Ryft\Dtos\ApplePay\ApplePayDomain;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * applePayWebDomainsList.
 *
 * List the web domains you have registered for Apple Pay
 */
class ApplePayWebDomainsList extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/apple-pay/web-domains';
    }

    /**
     * @param null|bool   $ascending   Control the order (newest or oldest) in which the payment sessions are returned. `false` will arrange the results with newest first, whereas `true` shows oldest first. The default is `false`.
     * @param null|int    $limit       Control how many items are return in a given page The max limit we allow is `50`. The default is `20`.
     * @param null|string $startsAfter A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results for that timestamp range.
     */
    public function __construct(
        protected ?bool $ascending = null,
        protected ?int $limit = null,
        protected ?string $startsAfter = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter([
            'ascending' => $this->ascending,
            'limit' => $this->limit,
            'startsAfter' => $this->startsAfter,
        ]);
    }

    public function createDtoFromResponse($response): mixed
    {
        return ApplePayDomain::fromPaginatedResponse($response);
    }
}
