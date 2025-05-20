<?php

namespace Nosco\Ryft\Traits\Concerns;

use Illuminate\Support\Collection;
use LogicException;
use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethod;
use Nosco\Ryft\Dtos\Payments\CustomerAddress;
use Nosco\Ryft\Exceptions\InvalidCustomer;
use Nosco\Ryft\Exceptions\InvalidPaymentMethod;

trait InteractsWithPaymentMethods
{
    /**
     * @throws InvalidCustomer
     * @throws LogicException
     */
    public function defaultPaymentMethod(): ?PaymentMethod
    {
        if (!$this->hasRyftId()) {
            return null;
        }

        $defaultId = $this->asRyftCustomer()->defaultPaymentMethod;

        if (!$defaultId) {
            return null;
        }

        return static::paymentMethods()->get($defaultId);
    }

    public function hasDefaultPaymentMethod(): bool
    {
        try {
            return $this->defaultPaymentMethod() !== null;
        } catch (InvalidCustomer|LogicException) {
            return false;
        }
    }

    /**
     * @return Collection<PaymentMethod>
     */
    public function paymentMethods(): Collection
    {
        if (!$this->hasRyftId()) {
            return collect();
        }

        return static::ryft()->customers()->listPaymentMethods($this->ryftId());
    }

    public function hasPaymentMethod(): bool
    {
        return $this->paymentMethods()->isNotEmpty();
    }

    /**
     * @throws InvalidPaymentMethod when no payment method ID is provided
     */
    protected function assertValidPaymentMethodId(PaymentMethod|string $paymentMethod): void
    {
        $paymentMethod = str($paymentMethod);

        if ($paymentMethod->isEmpty()) {
            throw InvalidPaymentMethod::idNotProvided();
        }
        if (!$paymentMethod->isMatch('/^pmt_[0-7][0-9A-HJKMNP-TV-Z]{25}/')) {
            throw InvalidPaymentMethod::malformedId($paymentMethod);
        }
    }

    protected function defaultBillingAddress(): ?CustomerAddress
    {
        return null;
    }
}
