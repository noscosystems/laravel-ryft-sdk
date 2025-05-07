<?php

namespace Nosco\Ryft\Contracts;

interface RyftCustomer
{
    public function ryftId(): ?string;

    public function ryftFirstName(): ?string;

    public function ryftLastName(): ?string;

    public function ryftEmail(): ?string;

    public function ryftMobilePhone(): ?string;

    public function ryftHomePhone(): ?string;

    public function ryftMetadata(): array;
}
