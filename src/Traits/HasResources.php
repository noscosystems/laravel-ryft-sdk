<?php

namespace Nosco\Ryft\Traits;

use Nosco\Ryft\Resource\AccountLinks;
use Nosco\Ryft\Resource\Accounts;
use Nosco\Ryft\Resource\ApplePay;
use Nosco\Ryft\Resource\Customers;
use Nosco\Ryft\Resource\Disputes;
use Nosco\Ryft\Resource\Events;
use Nosco\Ryft\Resource\Files;
use Nosco\Ryft\Resource\PaymentMethods;
use Nosco\Ryft\Resource\Payments;
use Nosco\Ryft\Resource\PayoutMethods;
use Nosco\Ryft\Resource\Persons;
use Nosco\Ryft\Resource\PlatformFees;
use Nosco\Ryft\Resource\Subscriptions;
use Nosco\Ryft\Resource\Transfers;
use Nosco\Ryft\Resource\Webhooks;

trait HasResources
{
    use HasConnector;

    /**
     * Generate temporary account link URLs to Ryft's portal for your sub accounts
     * to register and configure their payout details.
     *
     * This API can only be accessed for Hosted sub accounts.
     *
     * @link https://api-reference.ryftpay.com/#tag/Account-Links Documentation
     */
    public function accountLinks(): AccountLinks
    {
        return new AccountLinks($this->connector());
    }

    /**
     * Account registration for your sub accounts.
     *
     * @link https://api-reference.ryftpay.com/#tag/Accounts Documentation
     */
    public function accounts(): Accounts
    {
        return new Accounts($this->connector());
    }

    /**
     * Allows implementation of Apple Pay on the web via the API
     * with Ryft's Apple Pay processing certificate.
     *
     * @link https://api-reference.ryftpay.com/#tag/Apple-Pay Documentation
     */
    public function applePay(): ApplePay
    {
        return new ApplePay($this->connector());
    }

    /**
     * The Customers API allows you to persist customer details across sessions.
     *
     * You should use this if you wish to support saving a customer's payment methods
     * and thereby enabling them to reuse previously entered details for future payments.
     *
     * @link https://api-reference.ryftpay.com/#tag/Customers Documentation
     */
    public function customers(): Customers
    {
        return new Customers($this->connector());
    }

    /**
     * Disputes (also known as chargebacks) occur when a cardholder wants to query
     * or challenge a transaction on their card statement.
     *
     * The Disputes API allows you to keep track of and manage disputes.
     *
     * @link https://api-reference.ryftpay.com/#tag/Disputes Documentation
     */
    public function disputes(): Disputes
    {
        return new Disputes($this->connector());
    }

    /**
     * Events are persisted throughout the lifecycle of a payment/action as you use Ryft's API.
     *
     * Ryft use events to notify you when something important happens in your account (or a linked sub account).
     *
     * The most commonly used event occurs when a payment is captured,
     * in which case Ryft persist a `PaymentSession.captured` event
     * and then (optionally) send it to any webhooks you have registered
     * that are listening for that event type.
     *
     * Note that if you are taking payments as a platform (for sub accounts),
     * events are saved against the sub account `accountId`,
     * but will be sent to any webhooks that your account has configured.
     *
     * @link https://api-reference.ryftpay.com/#tag/Events Documentation
     */
    public function events(): Events
    {
        return new Events($this->connector());
    }

    /**
     * The Files API allows you to query for and upload files to Ryft.
     *
     * Some files may be generated internally by Ryft when requesting reports,
     * or alternatively you may have uploaded evidence/verification documents.
     *
     * @link https://api-reference.ryftpay.com/#tag/Files Documentation
     */
    public function files(): Files
    {
        return new Files($this->connector());
    }

    /**
     * The Payment Methods API allows you to tokenize and store previously used payment methods.
     *
     * @link https://api-reference.ryftpay.com/#tag/Payment-Methods Documentation
     */
    public function paymentMethods(): PaymentMethods
    {
        return new PaymentMethods($this->connector());
    }

    /**
     * Process payments with Ryft: authorizations, voids, captures, refunds etc.
     *
     * @link https://api-reference.ryftpay.com/#tag/Payments Documentation
     */
    public function payments(): Payments
    {
        return new Payments($this->connector());
    }

    /**
     * The Payout Methods API allows the creation and management of payout methods
     * for use when receiving payouts, e.g. bank accounts.
     *
     * Recommended if you wish to implement payouts programmatically for your sub accounts.
     *
     * @link https://api-reference.ryftpay.com/#tag/Payout-Methods Documentation
     */
    public function payoutMethods(): PayoutMethods
    {
        return new PayoutMethods($this->connector());
    }

    /**
     * The Persons API allows the creation and management of one or more persons
     * for the purpose of verification for Business sub accounts.
     *
     * Recommended if you wish to implement verification programmatically for your sub accounts.
     *
     * **This API cannot be accessed for Individual sub accounts.**
     *
     * @link https://api-reference.ryftpay.com/#tag/Persons Documentation
     */
    public function persons(): Persons
    {
        return new Persons($this->connector());
    }

    /**
     * Query any platform fees that your account has taken (when taking payments on behalf of linked sub accounts).
     *
     * @link https://api-reference.ryftpay.com/#tag/Platform-Fees Documentation
     */
    public function platformFees(): PlatformFees
    {
        return new PlatformFees($this->connector());
    }

    /**
     * The subscriptions API allows you to automatically have Ryft schedule
     * and charge recurring payments for a specific day and time.
     *
     * This API is not required to process recurring payments.
     *
     * After additional configuration, you can use Ryft's `payment-sessions` API
     * to create and charge the recurring payments yourself.
     *
     * @link https://api-reference.ryftpay.com/#tag/Subscriptions Documentation
     */
    public function subscriptions(): Subscriptions
    {
        return new Subscriptions($this->connector());
    }

    /**
     * A Transfer represents the movement of money between Ryft accounts.
     *
     * This API allows platforms/marketplaces to transfer money from/to particular sub accounts, useful when:
     *
     *  - you owe a sub account money from a particular transaction and want to explicitly send it after the fact
     *  - you want to recoup funds from a sub account, such as when dealing with disputes
     *  - you want to collect additional/new commission from the sub account
     *
     * @link https://api-reference.ryftpay.com/#tag/Transfers Documentation
     */
    public function transfers(): Transfers
    {
        return new Transfers($this->connector());
    }

    /**
     * Create and manage webhooks.
     *
     * ### Signatures
     *
     * As an additional security measure, you can verify the integrity of any webhook event you receive
     * by checking the signature Ryft provide within the Signature header.
     *
     * To do this simply take the webhook endpoint secret and HMAC-SHA256 the request body.
     *
     * If the signatures are not equal then you may want to discard the message.
     *
     * ### Retry Policy
     *
     * If your webhook URL begins to fail Ryft will start Ryft's retry mechanism.
     *
     * For each failing event Ryft immediately retries several times before
     * then retrying with an increasing delay until Ryft has exhausted the maximum number of attempts.
     *
     * Each retry happens after (0, 1, 5, 10, 10, 10 minutes)
     */
    public function webhooks(): Webhooks
    {
        return new Webhooks($this->connector());
    }
}
