<?php

namespace Nosco\Ryft\Requests\Payments;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * paymentSessionListTransactions.
 *
 * List the transaction(s) for a particular payment
 */
class PaymentSessionListTransactions extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/payment-sessions/{$this->paymentSessionId}/transactions";
    }

    /**
     * @param string      $paymentSessionId Payment Id to list transactions for
     * @param null|bool   $ascending        Control the order (newest or oldest) in which the transactions are returned. `false` will arrange the results with newest first, whereas `true` shows oldest first. The default is `false`.
     * @param null|int    $limit            Control how many items are return in a given page The max limit we allow is `50`. The default is `10`.
     * @param null|string $startsAfter      A token to identify the item to start querying after. This is most commonly used to get the next page of results after a previous response did not return all items, due to the imposed `limit`. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results for that timestamp range.
     */
    public function __construct(
        protected string $paymentSessionId,
        protected ?bool $ascending = null,
        protected ?int $limit = null,
        protected ?string $startsAfter = null,
    ) {}

    public function defaultQuery(): array
    {
        return array_filter(['ascending' => $this->ascending, 'limit' => $this->limit, 'startsAfter' => $this->startsAfter]);
    }
}
