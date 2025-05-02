<?php

namespace Nosco\Ryft\Requests\Subscriptions;

use Nosco\Ryft\Dtos\Subscriptions\PausedPaymentDetails;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Subscriptions\ReturnsSubscription;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * subscriptionPauseById.
 *
 * Used to schedule a pause for a Subscription. Only 'Active' subscriptions can be paused, though the
 * details for already 'Paused' subscriptions can also be edited. The subscription will remain in
 * 'Active' and will be moved to 'Paused' when it was next due to be billed. The reason or duration of
 * the pause can be edited by calling this endpoint again, even after it has moved to 'Paused'. After a
 * pause is scheduled but whilst still in 'Active', the pause can be unscheduled via the 'unschedule'
 * flag.
 */
class SubscriptionPauseById extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsSubscription;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/subscriptions/{$this->subscriptionId}/pause";
    }

    /**
     * @param string $subscriptionId Subscription to pause
     */
    public function __construct(
        protected string $subscriptionId,
        protected PausedPaymentDetails $pausedPaymentDetails,
    ) {}

    protected function defaultBody(): array
    {
        return $this->pausedPaymentDetails->toArray();
    }
}
