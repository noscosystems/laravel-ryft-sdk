<?php

namespace Nosco\Ryft\Dtos\Disputes;

use Nosco\Ryft\Dto;
use Nosco\Ryft\Dtos\Files\File;

readonly class Files extends Dto
{
    public function __construct(
        public ?File $proofOfDelivery = null,
        public ?File $customerSignature = null,
        public ?File $receipt = null,
        public ?File $shippingInformation = null,
        public ?File $customerCommunication = null,
        public ?File $refundPolicy = null,
        public ?File $recurringPaymentAgreement = null,
        public ?File $uncategorised = null,
    ) {}
}
