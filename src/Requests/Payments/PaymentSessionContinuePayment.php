<?php

namespace Nosco\Ryft\Requests\Payments;

use Nosco\Ryft\Dtos\Payments\PaymentSessionContinue;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Payments\ReturnsPaymentSession;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * paymentSessionContinuePayment.
 *
 * Submit additional data for payment sessions that require further action after using
 * `attempt-payment`.
 * **Note** that our SDKs handle this step automatically.
 */
class PaymentSessionContinuePayment extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsPaymentSession;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/payment-sessions/continue-payment';
    }

    public function __construct(protected PaymentSessionContinue $paymentSessionContinue) {}

    protected function defaultBody(): array
    {
        return $this->paymentSessionContinue->toArray();
    }
}
