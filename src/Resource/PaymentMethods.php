<?php

namespace Nosco\Ryft\Resource;

use Nosco\Ryft\Dtos\PaymentMethods\PaymentMethod;
use Nosco\Ryft\Requests\PaymentMethods\PaymentMethodDeleteById;
use Nosco\Ryft\Requests\PaymentMethods\PaymentMethodGetById;
use Nosco\Ryft\Requests\PaymentMethods\PaymentMethodUpdateById;
use Nosco\Ryft\Resource;

class PaymentMethods extends Resource
{
    /**
     * Retrieve a payment method by ID.
     *
     * This is used to fetch a payment method by its unique ID
     *
     * @param string $paymentMethodId Payment Method to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Payment-Methods/operation/paymentMethodGetById Documentation
     */
    public function get(string $paymentMethodId): PaymentMethod
    {
        return $this->connector
            ->send(new PaymentMethodGetById($paymentMethodId))
            ->dtoOrFail();
    }

    /**
     * Delete a payment method by ID.
     *
     * This is used to delete a payment method by instead.
     * Note that you can only delete payment-methods that aren't single-use.
     *
     * For example you can delete a customer's saved payment method,
     * but you cannot delete a token generated for one-time purchases.
     *
     * @param string $paymentMethodId Payment Method to delete
     *
     * @link https://api-reference.ryftpay.com/#tag/Payment-Methods/operation/paymentMethodDeleteById Documentation
     */
    public function delete(string $paymentMethodId): PaymentMethod
    {
        return $this->connector
            ->send(new PaymentMethodDeleteById($paymentMethodId))
            ->dtoOrFail();
    }

    /**
     * Update a payment method by ID.
     *
     * This is used to update an existing payment method
     *
     * @param string $paymentMethodId Payment Method to update
     *
     * @link https://api-reference.ryftpay.com/#tag/Payment-Methods/operation/paymentMethodUpdateById Documentation
     */
    public function update(string $paymentMethodId, PaymentMethod $paymentMethod): PaymentMethod
    {
        return $this->connector
            ->send(new PaymentMethodUpdateById($paymentMethodId, $paymentMethod))
            ->dtoOrFail();
    }
}
