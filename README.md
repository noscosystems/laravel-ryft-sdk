# An SDK for Ryft payments. Built on Saloon PHP, for Laravel.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/noscosystems/laravel-ryft.svg?style=flat-square)](https://packagist.org/packages/noscosystems/laravel-ryft)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/noscosystems/laravel-ryft/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/noscosystems/laravel-ryft/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/noscosystems/laravel-ryft/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/noscosystems/laravel-ryft/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/noscosystems/laravel-ryft.svg?style=flat-square)](https://packagist.org/packages/noscosystems/laravel-ryft)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require noscosystems/laravel-ryft-sdk
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="ryft-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="ryft-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="ryft-views"
```

## Usage

```php
$ryft = new Nosco\Ryft();
echo $ryft->echoPhrase('Hello, Nosco!');
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
