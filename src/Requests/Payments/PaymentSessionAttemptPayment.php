<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Dtos\Payments\PaymentSessionAttempt;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Payments\ReturnsPaymentSession;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * paymentSessionAttemptPayment.
 *
 * This is used to supply the card you have collected from the customer to pay for this payment session
 * Only call this endpoint from your front-end once you have collected the customer's card details.
 *
 * If
 * you want the lowest PCI burden we recommend using our embedded payment forms in place of this
 * endpoint. This ensures Ryft store & transmit the card details securely from our servers rather than
 * your own. Please contact your account manager if you want to opt for this.
 */
class PaymentSessionAttemptPayment extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsPaymentSession;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/payment-sessions/attempt-payment';
    }

    public function __construct(
        protected PaymentSessionAttempt $attempt
    ) {}

    protected function defaultBody(): array
    {
        return $this->attempt->toArray();
    }
}
