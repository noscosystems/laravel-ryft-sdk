<?php

namespace Nosco\Ryft\Traits\Concerns;

use Illuminate\Database\Eloquent\Model;
use LogicException;
use Nosco\Ryft\Dtos\Customers\Customer;
use Nosco\Ryft\Exceptions\CustomerAlreadyCreated;
use Nosco\Ryft\Exceptions\InvalidCustomer;

/**
 * @mixin Model
 */
trait ManagesCustomer
{
    use InteractsWithCustomer;
    use InteractsWithRyft;

    /**
     * @throws CustomerAlreadyCreated when this customer already exists in Ryft
     * @throws LogicException         when request to Ryft fails
     */
    public function createAsRyftCustomer(array $options = []): Customer
    {
        if ($this->hasRyftId()) {
            throw CustomerAlreadyCreated::exists($this);
        }

        $ryftCustomer = Customer::fromArray(array_merge($this->defaultRyftCustomerOptions(), $options));

        $dto = static::ryft()->customers()->create($ryftCustomer);

        $this->setRyftId($dto);

        return $dto;
    }

    /**
     * @throws InvalidCustomer when this customer is missing their Ryft ID
     * @throws LogicException  when request to Ryft fails
     */
    public function updateRyftCustomer(array $options = []): Customer
    {
        $this->assertRyftCustomerExists();

        $ryftCustomer = static::ryft()
            ->customers()
            ->update($this->ryftId(), Customer::fromArray($options));

        $this->setRyftId($ryftCustomer);

        return $ryftCustomer;
    }

    /**
     * @throws InvalidCustomer when this customer is missing their Ryft ID
     * @throws LogicException  when request to Ryft fails
     */
    public function syncRyftCustomer(): Customer
    {
        return $this->updateRyftCustomer($this->defaultRyftCustomerOptions());
    }

    /**
     * @throws InvalidCustomer when this customer is missing their Ryft ID
     * @throws LogicException  when request to Ryft fails
     */
    public function deleteRyftCustomer(): Customer
    {
        $this->assertRyftCustomerExists();

        $ryftCustomer = static::ryft()->customers()->delete($this->ryftId());

        $this->setRyftId(null);

        return $ryftCustomer;
    }

    /**
     * @throws CustomerAlreadyCreated when this customer already exists in Ryft
     * @throws LogicException         when request to Ryft fails
     */
    public function createOrGetRyftCustomer(array $options = []): Customer
    {
        try {
            return $this->asRyftCustomer();
        } catch (InvalidCustomer) {
            return $this->createAsRyftCustomer($options);
        }
    }

    /**
     * @throws LogicException when request to Ryft fails
     */
    public function updateOrCreateRyftCustomer(array $options = []): Customer
    {
        return $this->hasRyftId()
            ? $this->updateRyftCustomer($options)
            : $this->createAsRyftCustomer($options);
    }

    /**
     * @throws LogicException when request to Ryft fails
     */
    public function syncOrCreateRyftCustomer(array $options = []): Customer
    {
        return $this->hasRyftId()
            ? $this->syncRyftCustomer()
            : $this->createAsRyftCustomer($options);
    }

    public function ryftFirstName(): ?string
    {
        if (!isset($this->name) && !isset($this->first_name)) {
            return null;
        }
        if (isset($this->first_name)) {
            return $this->first_name;
        }

        return explode(' ', $this->name)[0] ?? null;
    }

    public function ryftLastName(): ?string
    {
        if (!isset($this->name) && !isset($this->last_name)) {
            return null;
        }
        if (isset($this->last_name)) {
            return $this->last_name;
        }

        return explode(' ', $this->name)[1] ?? null;
    }

    public function ryftEmail(): ?string
    {
        return $this->email ?? null;
    }

    public function ryftMobilePhone(): ?string
    {
        return $this->mobile_phone ?? null;
    }

    public function ryftHomePhone(): ?string
    {
        return $this->home_phone ?? null;
    }

    protected function defaultRyftCustomerOptions(): array
    {
        return [
            'firstName' => $this->ryftFirstName(),
            'lastName' => $this->ryftLastName(),
            'email' => $this->ryftEmail(),
            'mobilePhoneNumber' => $this->ryftMobilePhone(),
            'homePhoneNumber' => $this->ryftHomePhone(),
            'metadata' => $this->ryftMetadata(),
        ];
    }

    private function setRyftId(?string $id): void
    {
        $this->forceFill([
            'ryft_customer_id' => $id,
        ]);

        $this->save();
    }
}
