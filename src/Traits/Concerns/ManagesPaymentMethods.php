<?php

namespace Nosco\Ryft\Traits\Concerns;

use Illuminate\Database\Eloquent\Model;
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
    use InteractsWithPaymentMethods;
    use InteractsWithRyft;

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
    public function deletePaymentMethod(string $paymentMethod): PaymentMethod
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
    public function updateDefaultPaymentMethod(string $paymentMethod): Customer
    {
        $this->assertRyftCustomerExists();
        $this->assertValidPaymentMethodId($paymentMethod);

        return static::ryft()
            ->customers()
            ->update($this->ryftId(), new Customer(defaultPaymentMethod: $paymentMethod));
    }
}
