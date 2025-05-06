<?php

namespace Nosco\Ryft\Resource;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Payments\PaymentSession;
use Nosco\Ryft\Dtos\Subscriptions\PausedPaymentDetails;
use Nosco\Ryft\Dtos\Subscriptions\Subscription;
use Nosco\Ryft\Requests\Subscriptions\SubscriptionCancelById;
use Nosco\Ryft\Requests\Subscriptions\SubscriptionCreate;
use Nosco\Ryft\Requests\Subscriptions\SubscriptionGetById;
use Nosco\Ryft\Requests\Subscriptions\SubscriptionPauseById;
use Nosco\Ryft\Requests\Subscriptions\SubscriptionResumeById;
use Nosco\Ryft\Requests\Subscriptions\SubscriptionsList;
use Nosco\Ryft\Requests\Subscriptions\SubscriptionsListPaymentSessions;
use Nosco\Ryft\Requests\Subscriptions\SubscriptionUpdateById;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class Subscriptions extends Resource
{
    /**
     * List subscriptions.
     *
     * Used to fetch a paginated list of subscriptions
     *
     * @param int|null    $startTimestamp The start timestamp (inclusive), it must be before the endTimestamp.
     *                                    If not provided will default to midnight on the current date (UTC).
     * @param int|null    $endTimestamp   The timestamp when to return payment sessions up to (inclusive),
     *                                    it must be after the startTimestamp. If not provided it will default to the current time (UTC).
     * @param bool|null   $ascending      Control the order (newest or oldest) in which the subscriptions are returned.
     *                                    `false` will arrange the results with newest first, whereas `true` shows oldest first.
     *                                    The default is `false`.
     * @param int|null    $limit          Control how many items are return in a given page The max limit we allow is `25`.
     *                                    The default is `10`.
     * @param string|null $startsAfter    A token to identify where to resume a subsequent paginated query.
     *                                    The value of the `paginationToken` field from that response should be supplied here,
     *                                    to retrieve the next page of results for that timestamp range.
     *
     * @return Collection<Subscription>
     *
     * @link https://api-reference.ryftpay.com/#tag/Subscriptions/operation/subscriptionsList Documentation
     */
    public function list(
        ?int $startTimestamp = null,
        ?int $endTimestamp = null,
        ?bool $ascending = null,
        ?int $limit = null,
        ?string $startsAfter = null,
    ): Collection {
        return $this->connector
            ->send(new SubscriptionsList($startTimestamp, $endTimestamp, $ascending, $limit, $startsAfter))
            ->dtoOrFail();
    }

    /**
     * Creates a new subscription.
     *
     * Use to create a Subscription (whereby Ryft manage the automatic scheduling and billing of a recurring payment series)
     *
     * @link https://api-reference.ryftpay.com/#tag/Subscriptions/operation/subscriptionCreate Documentation
     */
    public function create(Subscription $subscription): Subscription
    {
        return $this->connector
            ->send(new SubscriptionCreate($subscription))
            ->dtoOrFail();
    }

    /**
     * Retrieve a subscription by ID.
     *
     * This is used to fetch a subscription by its unique ID
     *
     * @param string $subscriptionId Subscription to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Subscriptions/operation/subscriptionGetById Documentation
     */
    public function get(string $subscriptionId): Subscription
    {
        return $this->connector
            ->send(new SubscriptionGetById($subscriptionId))
            ->dtoOrFail();
    }

    /**
     * Updates a subscription by ID.
     *
     * Use to update a Subscription. Cannot be used if the Subscription is `Cancelled` or `Ended`.
     *
     * @param string $subscriptionId Subscription to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Subscriptions/operation/subscriptionUpdateById Documentation
     */
    public function update(string $subscriptionId, Subscription $subscription): Subscription
    {
        return $this->connector
            ->send(new SubscriptionUpdateById($subscriptionId, $subscription))
            ->dtoOrFail();
    }

    /**
     * Pause a subscription by ID.
     *
     * Used to schedule a pause for a Subscription. Only 'Active' subscriptions can be paused,
     * though the details for already 'Paused' subscriptions can also be edited.
     *
     * The subscription will remain in 'Active' and will be moved to 'Paused' when it was next due to be billed.
     *
     * The reason or duration of the pause can be edited by calling this endpoint again, even after it has moved to 'Paused'.
     *
     * After a pause is scheduled but whilst still in 'Active', the pause can be unscheduled via the 'unschedule' flag.
     *
     * @param string $subscriptionId Subscription to pause
     *
     * @link https://api-reference.ryftpay.com/#tag/Subscriptions/operation/subscriptionPauseById Documentation
     */
    public function pause(string $subscriptionId, PausedPaymentDetails $pausedPaymentDetails): Subscription
    {
        return $this->connector
            ->send(new SubscriptionPauseById($subscriptionId, $pausedPaymentDetails))
            ->dtoOrFail();
    }

    /**
     * Resume a subscription by ID.
     *
     * Used to resume a paused Subscription.
     *
     * @param string $subscriptionId Subscription to resume
     *
     * @link https://api-reference.ryftpay.com/#tag/Subscriptions/operation/subscriptionResumeById Documentation
     */
    public function resume(string $subscriptionId): Subscription
    {
        return $this->connector
            ->send(new SubscriptionResumeById($subscriptionId))
            ->dtoOrFail();
    }

    /**
     * Cancel a subscription by ID.
     *
     * Cancel a subscription by its unique ID.
     *
     * This will immediately move the subscription to Cancelled and stop billing the customer.
     *
     * This state is terminal and cannot be reversed.
     *
     * @param string $subscriptionId Subscription to cancel
     *
     * @link https://api-reference.ryftpay.com/#tag/Subscriptions/operation/subscriptionCancelById Documentation
     */
    public function cancel(string $subscriptionId): Subscription
    {
        return $this->connector
            ->send(new SubscriptionCancelById($subscriptionId))
            ->dtoOrFail();
    }

    /**
     * Retrieve a list of the payments specific to a subscription.
     *
     * Used to fetch a paginated list of the payment sessions making up the subscription
     *
     * @param string      $subscriptionId Subscription to retrieve
     * @param int|null    $startTimestamp The timestamp when to return payment sessions from (inclusive),
     *                                    it must be before the endTimestamp. If not provided it will default to 0
     * @param int|null    $endTimestamp   The timestamp when to return payment sessions up to (inclusive),
     *                                    it must be after the startTimestamp. If not provided it will default
     *                                    to the current time (UTC).
     * @param bool|null   $ascending      Control the order (newest or oldest) in which the payment sessions are returned.
     *                                    `false` will arrange the results with newest first,
     *                                    whereas `true` shows oldest first. The default is `false`.
     * @param int|null    $limit          Control how many items are return in a given page
     *                                    The max limit we allow is `25`. The default is `10`.
     * @param string|null $startsAfter    A token to identify where to resume a subsequent paginated query.
     *                                    The value of the `paginationToken` field from that response should be supplied here,
     *                                    to retrieve the next page of results.
     *
     * @return Collection<PaymentSession>
     *
     * @link https://api-reference.ryftpay.com/#tag/Subscriptions/operation/subscriptionsListPaymentSessions Documentation
     */
    public function listPaymentSessions(
        string $subscriptionId,
        ?int $startTimestamp = null,
        ?int $endTimestamp = null,
        ?bool $ascending = null,
        ?int $limit = null,
        ?string $startsAfter = null,
    ): Collection {
        return $this->connector
            ->send(new SubscriptionsListPaymentSessions(
                $subscriptionId,
                $startTimestamp,
                $endTimestamp,
                $ascending,
                $limit,
                $startsAfter
            ))
            ->dtoOrFail();
    }
}
