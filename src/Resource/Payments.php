<?php

namespace Nosco\Ryft\Resource;

use DateTimeInterface;
use Illuminate\Support\LazyCollection;
use Nosco\Ryft\Dtos\Payments\PaymentSession;
use Nosco\Ryft\Dtos\Payments\PaymentSessionAttempt;
use Nosco\Ryft\Dtos\Payments\PaymentSessionContinue;
use Nosco\Ryft\Dtos\Payments\PaymentTransaction;
use Nosco\Ryft\Requests\Payments\PaymentSessionAttemptPayment;
use Nosco\Ryft\Requests\Payments\PaymentSessionCaptureById;
use Nosco\Ryft\Requests\Payments\PaymentSessionContinuePayment;
use Nosco\Ryft\Requests\Payments\PaymentSessionCreate;
use Nosco\Ryft\Requests\Payments\PaymentSessionCreateRefund;
use Nosco\Ryft\Requests\Payments\PaymentSessionGet;
use Nosco\Ryft\Requests\Payments\PaymentSessionGetBetweenTimestamps;
use Nosco\Ryft\Requests\Payments\PaymentSessionGetTransactionById;
use Nosco\Ryft\Requests\Payments\PaymentSessionListTransactions;
use Nosco\Ryft\Requests\Payments\PaymentSessionUpdate;
use Nosco\Ryft\Requests\Payments\PaymentSessionVoidById;
use Nosco\Ryft\Resource;
use Nosco\Ryft\Support\Helpers;
use Saloon\Http\Response;

class Payments extends Resource
{
    /**
     * Retrieve payment sessions between timestamps.
     *
     * This is used to fetch payment sessions within a timestamp range, paginated
     *
     * @param DateTimeInterface|int|null $startTimestamp The timestamp when to return payment sessions from (inclusive),
     *                                                   it must be before the endTimestamp.
     *                                                   If not provided it will default to midnight on the current date (UTC).
     * @param DateTimeInterface|int|null $endTimestamp   The timestamp when to return payment sessions up to (inclusive),
     *                                                   it must be after the startTimestamp.
     *                                                   If not provided it will default to the current time (UTC).
     * @param bool                       $ascending      Control the order (newest or oldest) in which
     *                                                   the payment sessions are returned.
     *                                                   `false` will arrange the results with newest first,
     *                                                   whereas `true` shows oldest first. The default is `false`.
     * @param int|null                   $limit          Control how many items are return in a given page
     *                                                   The max limit we allow is `50`. The default is `10`.
     * @param string|null                $startsAfter    A token to identify the payment session to start querying after.
     *                                                   This is most commonly used to get the next page of results
     *                                                   after a previous response did not return all payment sessions,
     *                                                   due to the imposed `limit`.
     *                                                   The value of the `paginationToken` field from that response
     *                                                   should be supplied here, to retrieve the next page of results
     *                                                   for that timestamp range.
     *
     * @return LazyCollection<PaymentSession>
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionGetBetweenTimestamps Documentation
     *
     * @throws \LogicException on request failure
     */
    public function list(
        DateTimeInterface|int|null $startTimestamp = null,
        DateTimeInterface|int|null $endTimestamp = null,
        ?bool $ascending = null,
        ?int $limit = null,
        ?string $startsAfter = null,
    ): LazyCollection {
        $startTimestamp = Helpers::timestamp($startTimestamp);
        $endTimestamp = Helpers::timestamp($endTimestamp);

        return $this->connector
            ->paginate(new PaymentSessionGetBetweenTimestamps(
                $startTimestamp,
                $endTimestamp,
                $ascending,
                $limit,
                $startsAfter
            ))
            ->collect();
    }

    /**
     * Create a new payment session.
     *
     * The start of the payment flow. Call this request once the customer has proceeded to checkout.
     * Payment Sessions will auto-expire after several days if you don't take payment via the `/attempt-payment` endpoint.
     *
     * @see attempt() attempt-payment endpoint
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionCreate Documentation
     *
     * @throws \LogicException on request failure
     */
    public function create(PaymentSession $paymentSession): PaymentSession
    {
        return $this->connector
            ->send(new PaymentSessionCreate($paymentSession))
            ->dtoOrFail();
    }

    /**
     * Retrieve a payment session by ID.
     *
     * This is used to fetch a payment session by its `paymentSessionId`
     *
     * @param string $paymentSessionId Payment ID to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionGet Documentation
     *
     * @throws \LogicException on request failure
     */
    public function get(string $paymentSessionId): PaymentSession
    {
        return $this->connector
            ->send(new PaymentSessionGet($paymentSessionId))
            ->dtoOrFail();
    }

    /**
     * Update a payment session by ID.
     *
     * This is used to update a payment session by its ID.
     *
     * Note that this can only be used prior to a successful payment.
     * Once payment has been approved, you cannot update a `PaymentSession`.
     *
     * @param string $paymentSessionId Payment ID to update
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionUpdate Documentation
     *
     * @throws \LogicException on request failure
     */
    public function update(string $paymentSessionId, PaymentSession $paymentSession): PaymentSession
    {
        return $this->connector
            ->send(new PaymentSessionUpdate($paymentSessionId, $paymentSession))
            ->dtoOrFail();
    }

    /**
     * Attempts to pay for a payment session (take payment with a payment method) from your front-end.
     *
     * This is used to supply the card you have collected from the customer to pay for this payment session.
     * Only call this endpoint from your front-end once you have collected the customer's card details.
     *
     * If you want the lowest PCI burden Ryft recommend using the embedded payment forms in place of this endpoint.
     * This ensures Ryft store & transmit the card details securely from Ryft's servers rather than your own.
     * Please contact your account manager if you want to opt for this.
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionAttemptPayment Documentation
     *
     * @throws \LogicException on request failure
     */
    public function attempt(PaymentSessionAttempt $attempt): PaymentSession
    {
        return $this->connector
            ->send(new PaymentSessionAttemptPayment($attempt))
            ->dtoOrFail();
    }

    /**
     * Continue taking payment after the initial attempt.
     *
     * Submit additional data for payment sessions that require further action after using `/attempt-payment`.
     * **Note** that official SDKs handle this step automatically.
     *
     * @see attempt() attempt-payment endpoint
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionContinuePayment Documentation
     *
     * @throws \LogicException on request failure
     */
    public function continue(PaymentSessionContinue $paymentSessionContinue): PaymentSession
    {
        return $this->connector
            ->send(new PaymentSessionContinuePayment($paymentSessionContinue))
            ->dtoOrFail();
    }

    /**
     * List payment transaction(s).
     *
     * List the transaction(s) for a particular payment
     *
     * @param string      $paymentSessionId Payment ID to list transactions for
     * @param bool|null   $ascending        Control the order (newest or oldest) in which the transactions are returned.
     *                                      `false` will arrange the results with newest first,
     *                                      whereas `true` shows oldest first. The default is `false`.
     * @param int|null    $limit            Control how many items are return in a given page
     *                                      The max limit we allow is `50`. The default is `10`.
     * @param string|null $startsAfter      A token to identify the item to start querying after.
     *                                      This is most commonly used to get the next page of results after
     *                                      a previous response did not return all items, due to the imposed `limit`.
     *                                      The value of the `paginationToken` field from that response should be supplied here,
     *                                      to retrieve the next page of results for that timestamp range.
     *
     * @return LazyCollection<PaymentTransaction>
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionListTransactions Documentation
     *
     * @throws \LogicException on request failure
     */
    public function listTransactions(
        string $paymentSessionId,
        ?bool $ascending = null,
        ?int $limit = null,
        ?string $startsAfter = null,
    ): LazyCollection {
        return $this->connector
            ->paginate(new PaymentSessionListTransactions($paymentSessionId, $ascending, $limit, $startsAfter))
            ->collect();
    }

    /**
     * Retrieve a payment transaction.
     *
     * Retrieve the transaction for a particular payment
     *
     * @param string $paymentSessionId     Payment ID that the transaction is under
     * @param string $paymentTransactionId Payment transaction Id to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionGetTransactionById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function getTransaction(string $paymentSessionId, string $paymentTransactionId): PaymentTransaction
    {
        return $this->connector
            ->send(new PaymentSessionGetTransactionById($paymentSessionId, $paymentTransactionId))
            ->dtoOrFail();
    }

    /**
     * Manually capture a payment session that you have previously authorized.
     *
     * Call this endpoint to capture funds you have previously authorized on a payment session.
     *
     * You can only call this endpoint when the payment session is in status `Approved` and its `captureFlow` value is `Manual`.
     *
     * @param string $paymentSessionId Payment ID to update
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionCaptureById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function capture(string $paymentSessionId, PaymentTransaction $paymentTransaction): PaymentTransaction
    {
        return $this->connector
            ->send(new PaymentSessionCaptureById($paymentSessionId, $paymentTransaction))
            ->dtoOrFail();
    }

    /**
     * Voids a payment session awaiting manual capture.
     *
     * Call this endpoint to void a payment session currently awaiting manual capture.
     * This will reverse the amount authorized on the payment and return it to the customer.
     *
     * If voided on the same-day, the transaction will not show up on the customer's card statement(s).
     *
     * You can only call this endpoint when the payment session is in status `Approved` and its `captureFlow` value is `Manual`.
     *
     * @param string $paymentSessionId Payment ID to void
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionVoidById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function void(string $paymentSessionId): PaymentTransaction
    {
        return $this->connector
            ->send(new PaymentSessionVoidById($paymentSessionId))
            ->dtoOrFail();
    }

    /**
     * Refund an already captured payment.
     *
     * Use this endpoint to refund an already captured payment session.
     * Unlike voids, which are typically completed in minutes, refunds can take several days to be cleared by the card schemes.
     *
     * @param string $paymentSessionId Payment ID to refund
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionCreateRefund Documentation
     *
     * @throws \LogicException on request failure
     */
    public function createRefund(string $paymentSessionId, PaymentTransaction $paymentTransaction): PaymentTransaction
    {
        return $this->connector
            ->send(new PaymentSessionCreateRefund($paymentSessionId, $paymentTransaction))
            ->dtoOrFail();
    }
}
