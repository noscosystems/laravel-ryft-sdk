<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Request;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * paymentSessionCreateRefund.
 *
 * Use this endpoint to refund an already captured payment session. Unlike voids, which are typically
 * completed in minutes, refunds can take several days to be cleared by the card schemes.
 */
class PaymentSessionCreateRefund extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/payment-sessions/{$this->paymentSessionId}/refunds";
    }

    /**
     * @param string $paymentSessionId Payment Id to refund
     */
    public function __construct(
        protected string $paymentSessionId,
    ) {}
}
