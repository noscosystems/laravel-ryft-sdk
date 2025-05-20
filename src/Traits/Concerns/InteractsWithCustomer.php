<?php

namespace Nosco\Ryft\Traits\Concerns;

use LogicException;
use Nosco\Ryft\Dtos\Customers\Customer;
use Nosco\Ryft\Exceptions\InvalidCustomer;

trait InteractsWithCustomer
{
    public function ryftId(): ?string
    {
        return $this->ryft_customer_id ?? null;
    }

    public function hasRyftId(): bool
    {
        return $this->ryftId() !== null;
    }

    public function ryftMetadata(): array
    {
        return [
            'owner_id' => $this->id ?? null,
        ];
    }

    /**
     * @throws InvalidCustomer when this customer is missing their Ryft ID
     */
    protected function assertRyftCustomerExists(): void
    {
        if (!$this->hasRyftId()) {
            throw InvalidCustomer::notYetCreated($this);
        }
        if (!str($this->ryftId())->isMatch('/^cus_[0-7][0-9A-HJKMNP-TV-Z]{25}/')) {
            throw InvalidCustomer::malformedId($this->ryftId());
        }
    }

    /**
     * @throws InvalidCustomer when this customer is missing their Ryft ID
     * @throws LogicException  when request to Ryft fails
     */
    public function asRyftCustomer(): Customer
    {
        $this->assertRyftCustomerExists();

        return static::ryft()->customers()->get($this->ryftId());
    }
}
