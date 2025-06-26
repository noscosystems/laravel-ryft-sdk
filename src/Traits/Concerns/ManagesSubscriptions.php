<?php

namespace Nosco\Ryft\Traits\Concerns;

use DateTimeInterface;
use Nosco\Ryft\Dtos\Payments\CustomerAddress;
use Nosco\Ryft\Dtos\Subscriptions\PausedPaymentDetails;
use Nosco\Ryft\Dtos\Subscriptions\RecurringInterval;
use Nosco\Ryft\Dtos\Subscriptions\Subscription;
use Nosco\Ryft\Exceptions\InvalidCustomer;
use Nosco\Ryft\Exceptions\InvalidPayoutMethod;
use Nosco\Ryft\Exceptions\InvalidSubscription;
use Nosco\Ryft\Requests\Subscriptions\SubscriptionsList;
use Saloon\PaginationPlugin\Paginator;

trait ManagesSubscriptions
{
    use InteractsWithCustomer;
    use InteractsWithPaymentMethods;
    use InteractsWithRyft;

    /**
     * @param DateTimeInterface|null $from If not provided will default to midnight on the current date (UTC).
     * @param DateTimeInterface|null $to   It must be after the startTimestamp.
     *                                     If not provided it will default to the current time (UTC).
     *
     * @return Paginator<Subscription>
     */
    public function subscriptions(?DateTimeInterface $from = null, ?DateTimeInterface $to = null): Paginator
    {
        return static::ryft()
            ->paginate(new SubscriptionsList($from?->getTimestamp(), $to?->getTimestamp()));
    }

    public function findSubscription(string $subscription): Subscription
    {
        return static::ryft()->subscriptions()->get($subscription);
    }

    /**
     * @throws InvalidPayoutMethod
     * @throws InvalidCustomer
     * @throws InvalidSubscription
     */
    public function newSubscription(
        int $price,
        RecurringInterval $interval,
        ?string $description = null,
        ?string $paymentMethod = null,
        ?DateTimeInterface $startDate = null,
        ?CustomerAddress $billingAddress = null,
        array $metadata = [],
    ): Subscription {
        return static::ryft()
            ->subscriptions()
            ->create($this->createSubscription(
                price: $price,
                interval: $interval,
                description: $description,
                paymentMethod: $paymentMethod,
                startDate: $startDate,
                billingAddress: $billingAddress,
                metadata: $metadata,
            ));
    }

    /**
     * @throws InvalidPayoutMethod
     * @throws InvalidCustomer
     * @throws InvalidSubscription
     */
    public function updateSubscription(
        string $subscription,
        ?int $price = null,
        ?RecurringInterval $interval = null,
        ?string $description = null,
        ?string $paymentMethod = null,
        ?DateTimeInterface $startDate = null,
        ?CustomerAddress $billingAddress = null,
        array $metadata = [],
    ): Subscription {
        return static::ryft()
            ->subscriptions()
            ->update($subscription, $this->createSubscription(
                price: $price,
                interval: $interval,
                description: $description,
                paymentMethod: $paymentMethod,
                startDate: $startDate,
                billingAddress: $billingAddress,
                metadata: $metadata,
            ));
    }

    /**
     * @throws InvalidSubscription
     */
    public function pauseSubscription(
        string $subscription,
        ?string $reason = null,
        ?DateTimeInterface $pauseDate = null,
        ?DateTimeInterface $resumeDate = null,
    ): Subscription {
        $this->assertValidSubscriptionId($subscription);

        return static::ryft()->subscriptions()->pause($subscription, new PausedPaymentDetails(
            reason: $reason,
            resumeAtTimestamp: $resumeDate?->getTimestamp(),
            pausedAtTimestamp: $pauseDate?->getTimestamp(),
        ));
    }

    /**
     * @throws InvalidSubscription
     */
    public function unscheduleSubscriptionPause(string $subscription): Subscription
    {
        $this->assertValidSubscriptionId($subscription);

        return static::ryft()->subscriptions()->pause($subscription, new PausedPaymentDetails(
            unschedule: true,
        ));
    }

    /**
     * @throws InvalidSubscription
     */
    public function resumeSubscription(string $subscription): Subscription
    {
        $this->assertValidSubscriptionId($subscription);

        return static::ryft()->subscriptions()->resume($subscription);
    }

    public function cancelSubscription(string $subscription): Subscription
    {
        return static::ryft()->subscriptions()->cancel($subscription);
    }

    protected function subscriptionStatementDescriptor(): ?string
    {
        return config('ryft.payments.statement.descriptor');
    }

    protected function subscriptionStatementCity(): ?string
    {
        return config('ryft.payments.statement.city');
    }

    /**
     * @throws InvalidSubscription
     */
    protected function assertValidSubscriptionId(string $subscription): void
    {
        if (!str($subscription)->isMatch('/^sub_[0-7][0-9A-HJKMNP-TV-Z]{25}/')) {
            throw InvalidSubscription::malformedId($subscription);
        }
    }

    /**
     * @throws InvalidPayoutMethod
     * @throws InvalidSubscription
     * @throws InvalidCustomer
     */
    private function createSubscription(
        int $price,
        RecurringInterval $interval,
        ?string $description = null,
        ?string $paymentMethod = null,
        ?DateTimeInterface $startDate = null,
        ?CustomerAddress $billingAddress = null,
        array $metadata = [],
    ): Subscription {
        if (str($paymentMethod)->isEmpty()) {
            $paymentMethod = $this->defaultPaymentMethod()->id;

            if (!$paymentMethod) {
                throw InvalidPayoutMethod::defaultNotSet($this);
            }
        }
        if (!$billingAddress ??= $this->defaultBillingAddress()) {
            throw InvalidSubscription::noBillingAddress();
        }

        $metadata = collect($this->ryftMetadata())->merge($metadata)->take(5);

        return Subscription::fromArray([
            'price' => [
                'amount' => $price,
                'currency' => config('ryft.currency'),
                'interval' => $interval,
            ],
            'paymentMethod' => [
                'id' => $paymentMethod,
            ],
            'description' => $description,
            'billingCycleTimestamp' => $startDate?->getTimestamp(),
            'metadata' => $metadata,
            'shippingDetails' => [
                'address' => $billingAddress,
            ],
            'paymentSettings' => [
                'statementDescriptor' => [
                    'descriptor' => $this->subscriptionStatementDescriptor(),
                    'city' => $this->subscriptionStatementCity(),
                ],
            ],
            'customer' => [
                'id' => $this->ryftId(),
            ],
        ]);
    }
}
