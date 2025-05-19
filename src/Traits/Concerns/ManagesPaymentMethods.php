<?php

namespace Nosco\Ryft\Traits\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use LogicException;
use Nosco\Ryft\Dtos\Customers\Customer;
use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethod;
use Nosco\Ryft\Exceptions\InvalidCustomer;
use Nosco\Ryft\Exceptions\InvalidPaymentMethod;

/**
 * @mixin Model
 */
trait ManagesPaymentMethods
{
    use InteractsWithCustomer;
    use InteractsWithRyft;

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
     * @throws InvalidCustomer
     * @throws InvalidPaymentMethod
     * @throws LogicException
     */
    public function updatePaymentMethod(PaymentMethod $paymentMethod): PaymentMethod
    {
        if (!$paymentMethod->id) {
            throw InvalidPaymentMethod::idNotProvided();
        }

        $this->assertRyftCustomerExists();

        // Ryft only allows updating billing address.
        $editedPaymentMethod = new PaymentMethod(
            billingAddress: $paymentMethod->billingAddress
        );

        return static::ryft()->paymentMethods()->update($paymentMethod->id, $editedPaymentMethod);
    }

    /**
     * @throws InvalidPaymentMethod
     * @throws InvalidCustomer
     * @throws LogicException
     */
    public function deletePaymentMethod(PaymentMethod|string $paymentMethod): PaymentMethod
    {
        $this->assertRyftCustomerExists();
        $this->assertValidPaymentMethodId($paymentMethod);

        return static::ryft()->paymentMethods()->delete($paymentMethod);
    }

    /**
     * @throws InvalidCustomer
     * @throws InvalidPaymentMethod
     * @throws LogicException
     */
    public function updateDefaultPaymentMethod(PaymentMethod|string $paymentMethod): Customer
    {
        $this->assertRyftCustomerExists();
        $this->assertValidPaymentMethodId($paymentMethod);

        $paymentMethodId = $paymentMethod instanceof PaymentMethod
            ? $paymentMethod->id
            : $paymentMethod;

        return static::ryft()
            ->customers()
            ->update($this->ryftId(), new Customer($paymentMethodId));
    }

    /**
     * @throws InvalidPaymentMethod when no payment method ID is provided
     */
    protected function assertValidPaymentMethodId(PaymentMethod|string $paymentMethod): void
    {
        if ($paymentMethod instanceof PaymentMethod) {
            $paymentMethod = $paymentMethod->id;
        }
        if (!$paymentMethod) {
            throw InvalidPaymentMethod::idNotProvided();
        }
        if (!str($paymentMethod)->isMatch('/^pmt_[0-7][0-9A-HJKMNP-TV-Z]{25}/')) {
            throw InvalidPaymentMethod::malformedId($paymentMethod);
        }
    }
}
