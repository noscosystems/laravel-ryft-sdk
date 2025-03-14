<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Dtos\PaymentSession;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\ReturnsPaymentSession;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * paymentSessionUpdate.
 *
 * This is used to update a payment session by its Id. Note that this can only be used prior to a
 * successful payment. Once payment has been approved, you cannot update a PaymentSession.
 */
class PaymentSessionUpdate extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsPaymentSession;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/payment-sessions/{$this->paymentSessionId}";
    }

    /**
     * @param string $paymentSessionId Payment Id to update
     */
    public function __construct(
        protected string $paymentSessionId,
        protected PaymentSession $paymentSession,
    ) {}
}
