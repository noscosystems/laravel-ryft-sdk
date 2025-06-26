# Laravel Ryft SDK

An SDK for Ryft payments. Built on Saloon PHP, for Laravel.

## Installation

First, install the package using Composer package manager

```bash
composer require noscosystems/laravel-ryft-sdk
```

### Install via command

You may choose to publish all files from this package via the following command:

```bash
php artisan ryft:install
```

Then, migrate your database:

```bash
php artisan migrate
```

This will add several columns to your `users` table to hold information relating
your Laravel app's users to Ryft customers and payout accounts.

### Install manually

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="ryft-migrations"
php artisan migrate
```

Optionally, you may publish the configuration file using this command:

```bash
php artisan vendor:publish --tag="ryft-config"
```

## Configuration

### Billable Model

You may choose to use the Billable trait in your authenticatable model definition.
Typically this will be the `App\Models\User` model, but you may choose any
authenticatable model you wish. This trait provides various methods to
allow you to perform common billing tasks, similar to Laravel Cashier's Billable model.

> [!WARNING]
> If your chosen authenticatable model is not `\App\Models\User`,
> you must adjust the migration to use your model's table.

```php
use Nosco\Ryft\Traits\Concerns\Billable;

class User extends Authenticatable
{
    use Billable;
}

```

### Payable Model

Similarly to the Billable model, you may include the Payable trait in your
authenticatable model definition. This trait provides methods that allow you to
perform common tasks relating to paying out to users.

> [!WARNING]
> If your chosen authenticatable model is not `\App\Models\User`,
> you must adjust the migration to use your model's table.

```php
use Nosco\Ryft\Traits\Concerns\Payable;

class User extends Authenticatable
{
    use Payable;
}

```

### API Keys

You must configure your Ryft API keys for this package to work correctly.
You can retrieve the API keys from Ryft's developer control panel and set the
environment variables in your application's `.env` file.

```dotenv
RYFT_PUBLIC_KEY="YOUR_RYFT_PUBLIC_KEY"
RYFT_SECRET_KEY="YOUR_RYFT_SECRET_KEY"
```

> [!CAUTION]
> Ryft's secret keys are intended to be used in the backend only.
> Public keys must be used when attempting payments using the API in the frontend
> or using Ryft's embedded payment form.

### Currency

The default currency for ryft is United States Dollars (USD).
You can change the default by setting the `RYFT_CURRENCY` variable
within your application's `.env` file. If the variable is not set,
Ryft will attempt to use `APP_CURRENCY` if populated before falling back to USD.

```dotenv
RYFT_CURRENCY="GBP"
```

## Usage

### Customers

#### Creating Customers

You may create a Ryft customer by calling the `createAsRyftCustomer` method:

```php
$ryftCustomer = $user->createAsRyftCustomer();
```

A Ryft customer is required to store payment methods and create subscriptions.

You may provide additional parameters via an `$options` array which are [supported
by the Ryft API](https://api-reference.ryftpay.com/#tag/Customers/operation/customerCreate):

```php
$ryftCustomer = $user->createAsRyftCustomer($options);
```

You may use the `asRyftCustomer` method if you want to return the Ryft customer
object for a model using the Billable trait:

```php
$ryftCustomer = $user->asRyftCustomer();
```

The `createOrGetRyftCustomer` method may be used if you are unsure if a Billable
model already has a Ryft customer account. A new Ryft customer will be created
if the model is missing its `ryft_customer_id`:

```php
$ryftCustomer = $user->createOrGetRyftCustomer();
```

#### Updating Customers

You may update Ryft customer details by using the `updateRyftCustomer` method.
This method accepts a `Customer` data transfer object (DTO) containing options
[supported by Ryft's API](https://api-reference.ryftpay.com/#tag/Customers/operation/customerUpdateById):

```php
use Nosco\Ryft\Dtos\Customers;

$customer = new Customer(lastName: 'Doe');

// Alternative array syntax
// $customer = Customer::fromArray(['lastName' => 'Doe']);

$user->updateRyftCustomer($customer);
```

#### Syncing Customer Data With Ryft

When a user updates their information, you may want to update their record on Ryft
to prevent the two becoming out of sync.

To do this, you may use the `syncRyftCustomerDetails` method to update all information
of that user stored by Ryft:

```php
$user->syncRyftCustomerDetails();
```

You may automate this process by listening to the `updated` event of your
Billable model.

This can be done on the Billable model itself:

```php
use App\Models\User;
use function Illuminate\Events\queueable;

protected static function booted(): void
{
    static::updated(queueable(function (User $user) {
        if ($user->hasRyftId()) {
            $user->syncRyftCustomerDetails();
        }
    }));
}
```

Or, this can be done within an observer attached to your Billable model:

```php
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(BillableObserver::class)]
class User extends Authenticatable
{
    //
}
```

```php
use App\Models\User;
use function Illuminate\Events\queueable;

class BillableObserver
{
    public function updated(User $user): void
    {
        if ($user->hasRyftId()) {
            $user->syncRyftCustomerDetails();
        }
    }
}
```

You may customize the customers' information to be sent to Ryft by overriding
various methods provided by the Billable trait. For example, you may override
the `ryftFirstName` method to customize the customer's first name to be sent to
Ryft:

```php
public function ryftFirstName(): ?string
{
    return str($this->name)->before(' ')->trim()->toString() ?: null;
}
```

Similarly, you may override the `ryftLastName`, `ryftEmail`, `ryftHomePhone`,
and `ryftMobilePhone` methods. These methods will sync information to
their corresponding customer parameters when creating or updating a Ryft customer.

### Payments

Creating Ryft payments is achieved by creating payment sessions. The payment
session must contain the transaction value and currency, and may include additional
information [supported by Ryft's API](https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionCreate).

#### Creating a payment method

There is currently only only one approach to store customers' payment methods: by creating a payment.

You may choose to let the user save their card upon payment or initiate a
zero-value authorization. Please consult [Ryft's documentation to configure the
payment session](https://developer.ryftpay.com/docs/integrate/web/embedded-sdk/save-cards-for-future-payments/).

If you are using
a [server-to-server](https://developer.ryftpay.com/docs/integrate/web/server-to-server/save-cards-for-future-payments/)
approach, you can specify whether the payment method should be stored by setting `paymentMethodOptions.store` as `true`
when creating a payment session.

> [!IMPORTANT]
> Ryft recommends that your application use their embedded payment form.
> If you want to use a server-to-server approach to attempt payments,
> your application must be PCI DSS compliant.

#### Creating a payment session

To initiate a payment, you must first create a payment session. You can achieve
this using the bundled Saloon SDK:

```php
use Nosco\Ryft\Ryft;
use Nosco\Ryft\Dtos\Customers\Customer;
use Nosco\Ryft\Dtos\Payments\PaymentSession;

$paymentSession = Ryft::payments()->create(new PaymentSession(
    amount: 1000,
    currency: 'GBP',
    customerDetails: new Customer(
        id: $user->ryftId(),
    ),
));
```

Please consult [Ryft's API](https://api-reference.ryftpay.com/#tag/Payments/operation/paymentSessionCreate)
for supported options and instructions to set-up subscriptions.

> [!NOTE]
> `customerDetails` must only contain the user's Ryft customer ID if they already
> have one. Other parameters are for creating a new Ryft customer.

#### Attempting a payment

After a payment session was created, Ryft will return the payment session with
the `clientSecret` property populated. The `clientSecret` is a unique token for
interacting with the payment session and it must be supplied when attempting to
complete the payment session.

You can supply the user's card information when attempting to complete the payment
session:

```php
use Nosco\Ryft\Ryft;
use Nosco\Ryft\Dtos\Payments\PaymentSessionAttempt;
use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethodOptions;
use Nosco\Ryft\Dtos\PaymentMethods\Card;

$paymentSession = Ryft::payments()->attempt(new PaymentSessionAttempt(
    clientSecret: 'ps_01FCTS1XMKH9FF43CAFA4CXT3P_secret_b83f2653-06d7-44a9-a548-5825e8186004',
    cardDetails: new Card(
        number: '4444333322221111',
        expiryMonth: '10',
        expiryYear: '2028',
        cvc: '100'
    ),
    paymentMethodOptions: new PaymentMethodOptions(
        store: true,
    ),
));
```

#### Error Handling

Once an attempt is made, you may check if there are any errors returned by Ryft
regarding the customer's supplied card details by referencing the `lastError`
property
with [Ryft's list of possible errors](https://developer.ryftpay.com/docs/integrate/web/server-to-server/#pendingpayment):

```php
if ($paymentSession->lastError) {
    // Handle error
}
```

There may be a few times
where [further action is required by the user](https://developer.ryftpay.com/docs/integrate/web/server-to-server/#pendingaction)
to verify that they are the authorized user of that card. In such cases,
Ryft will return a `PaymentSessionAttempt` object with the status of
`PendingAction` and containing a redirect url in the `requiredAction.url` property:

```php
// Redirect user to 3DS auth flow if required.
if ($paymentSessionAttempt->requiredAction?->url) {
    $this->redirect($paymentSessionAttempt->requiredAction->url);
}
```

Once the user had successfully complete the 3DS authorization flow,
you can continue the attempt by supplying the captured 3DS information:

```php
use Nosco\Ryft\Ryft;
use Nosco\Ryft\Dtos\Payments\PaymentSessionContinue;
use Nosco\Ryft\Dtos\Payments\ThreeDsRequestContinue;

Ryft::payments()->continue(new PaymentSessionContinue(
    clientSecret: 'ps_01FCTS1XMKH9FF43CAFA4CXT3P_secret_b83f2653-06d7-44a9-a548-5825e8186004',
    threeDs: new ThreeDsRequestContinue(
        fingerprint: 'ewogICJ0aHJlZURTU2VydmVyVHJhbnNJRCI6ICI4ZjAxNzdhNC0yY2VkLTQ4NjUtODViNy1iYWQ5YmZhMzk4ZDIiLAogICJ0aHJlZURTQ29tcEluZCI6IlkiCn0=',
    ),
));
```

A successful payment is determined by either an `Approved` or `Captured` status.
You may redirect the user to a success page if either statuses are achieved.

### Payment Methods

#### Retrieving Payment Methods

The `paymentMethods` method on the Billable model fetch and return a collection of
`Nosco\Ryft\Dtos\PaymentMethods\PaymentMethod` instances directly from Ryft's API:

```php
$paymentMethods = $user->paymentMethods();
```

To retrieve a customer's default payment method from the API,
the `defaultPaymentMethod` method may be used:

```php
$defaultPaymentMethod = $user->defaultPaymentMethod();
```

You can retrieve a specific payment method that is attached
to the Billable model using the `findPaymentMethod` method:

```php
$paymentMethod = $user->findPaymentMethod($paymentMethodId);
```

#### Payment Method Presence

To determine if a billable model has a default payment method attached
to their customer account, invoke the `hasDefaultPaymentMethod` method:

```php
if ($user->hasDefaultPaymentMethod()) {
    // ...
}
```

You may use the `hasPaymentMethod` method to determine if a Billable model has
at least one payment method attached to their customer account:

```php
if ($user->hasPaymentMethod()) {
    // ...
}
```

#### Updating the Default Payment Method

The `updateDefaultPaymentMethod` method may be used to update a user's
default payment method information to the provided payment method ID:

```php
$user->updateDefaultPaymentMethod($paymentMethodId);
```

#### Deleting a payment method

To delete a payment method you may call the `deletePaymentMethod` method on the
Billable model:

```php
$user->deleteDefaultPaymentMethod($paymentMethodId);
```

> [!NOTE]
> If the Ryft customer is deleted, all of their payment methods will also be deleted.

### Subscriptions

#### Creating Subscriptions

> [!IMPORTANT]
> In order to create subscriptions with Ryft, you will need to store at least
> one payment method on the user's Ryft customer account.

To create a subscription, first retrieve an instance of your Billable model,
which typically will be an instance of `App\Models\User`.
Once you have retrieved the model instance, you may use the `newSubscription`
method to create the subscription:

```php
use Nosco\Ryft\Dtos\Subscriptions\RecurringInterval;
use Nosco\Ryft\Enums\Subscriptions\RecurringIntervalUnit;

// Create a 9.99 USD monthly subscription,
// starting today, using the default payment method.
$user->newSubscription(
    price: 999,
    interval: new RecurringInterval(
        unit: RecurringIntervalUnit::MONTHS,
        count: 1
    ),
);
```

You may specify which payment method to charge subscription fees by supplying
it in the `paymentMethod` parameter:

```php
use Nosco\Ryft\Dtos\Subscriptions\RecurringInterval;
use Nosco\Ryft\Enums\Subscriptions\RecurringIntervalUnit;

$user->newSubscription(
    price: 999,
    interval: new RecurringInterval(
        unit: RecurringIntervalUnit::MONTHS,
        count: 1
    ),
    paymentMethod: 'pmt_01FCTS1XMKH9FF43CAFA4CXT3P',
);
```

In cases where you may want the subscription to start at a later date,
you may supply a `DateTimeInterface` object to the `startDate` parameter:

```php
use Nosco\Ryft\Dtos\Subscriptions\RecurringInterval;
use Nosco\Ryft\Enums\Subscriptions\RecurringIntervalUnit;

// Create a 9.99 USD monthly subscription starting at the beginning of next month.
$user->newSubscription(
    price: 999,
    interval: new RecurringInterval(
        unit: RecurringIntervalUnit::MONTHS,
        count: 1
    ),
    startDate: today()->addMonth()->startOfMonth(),
);
```

> [!NOTE]
> The subscription currency will be the currency configured in your environment
> variable `RYFT_CURRENCY`.

#### Retrieving Subscriptions

The `subscriptions` method on the Billable model fetch and return a
Saloon paginated collection of `Nosco\Ryft\Dtos\Subscriptions\Subscription`
instances directly from Ryft's API:

```php
$subscriptions = $user->subscriptions();
```

You may specify the time ranges of start dates when retrieving a list of
subscriptions by supplying `DateTimeInterface` objects:

```php
// Subscriptions starting in the next month
$subscriptions = $user->subscriptions(
    from: today(),
    to: today()->addMonth(),
);
```

You can retrieve a specific payment method that is attached to the Billable
model using the `findPaymentMethod` method:

```php
$user->findSubscription('sub_01FCTS1XMKH9FF43CAFA4CXT3P');
```

#### Pausing a Subscription

To pause a subscription, call the `pauseSubscription` method on the Billable model:

```php
$user->pauseSubscription('sub_01FCTS1XMKH9FF43CAFA4CXT3P');
```

You may optionally specify a reason for the subscription pause
using the `reason` parameter.

If you or the user wants to temporarily pause a subscription for a known length
of time, you may specify a future `resumeDate` with a `DateTimeInterface` object:

```php
// Pause a subscription for one month.
$user->pauseSubscription(
    subscription: 'sub_01FCTS1XMKH9FF43CAFA4CXT3P',
    reason: 'Free month promotion',
    resumeDate: today()->addMonth(),
);
```

To schedule a subscription pause at a future date, specify a future
`pauseDate` with a `DateTimeInterface` object:

```php
// Pause a subscription from tomorrow onwards.
$user->pauseSubscription(
    subscription: 'sub_01FCTS1XMKH9FF43CAFA4CXT3P',
    pauseDate: today()->addDay(),
);
```

When a subscription is scheduled to be paused and is currently not yet paused,
you may unschedule it by calling `unscheduleSubscriptionPause` method
on the Billable model:

```php
$user->unscheduleSubscriptionPause('sub_01FCTS1XMKH9FF43CAFA4CXT3P');
```

#### Resuming a Subscription

If a subscription is currently paused, you may resume it by calling
`resumeSubscription` method on the Billable model:

```php
$user->resumeSubscription('sub_01FCTS1XMKH9FF43CAFA4CXT3P');
```

> [!IMPORTANT]
> Ryft does not allow a cancelled subscription to be resumed. If you want to
> achieve that effect, you may pause a subscription indefinitely instead.

#### Cancelling a Subscription

To cancel a subscription, call the `cancelSubscription` method on the Billable model.
Optionally, you may provide the reason for cancellation using the `reason` parameter:

```php
$user->cancelSubscription(
    subscription: 'sub_01FCTS1XMKH9FF43CAFA4CXT3P',
    reason: 'Cancelled by user',
);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Puttiong Ander Vidal](https://github.com/pavidal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
