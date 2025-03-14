<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Dtos\Payments\PaymentSession;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Payments\ReturnsPaymentSession;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * paymentSessionCreate.
 *
 * The start of the payment flow. Call this request once the customer has proceeded to checkout.
 * Payment Sessions will auto-expire after several days if you don't take payment via the
 * `attempt-payment` endpoint.
 */
class PaymentSessionCreate extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsPaymentSession;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/payment-sessions';
    }

    public function __construct(protected readonly PaymentSession $paymentSession) {}

    protected function defaultBody(): array
    {
        return $this->paymentSession->toArray();
    }
}
