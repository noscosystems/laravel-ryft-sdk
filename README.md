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
