<?php

namespace Nosco\Ryft\Enums\Disputes;

enum EvidenceType: string
{
    case PROOF_OF_DELIVERY = 'ProofOfDelivery';
    case BILLING_ADDRESS = 'BillingAddress';
    case SHIPPING_ADDRESS = 'ShippingAddress';
    case DUPLICATE_TRANSACTION = 'DuplicateTransaction';
    case CUSTOMER_SIGNATURE = 'CustomerSignature';
    case RECEIPT = 'Receipt';
    case SHIPPING_CONFIRMATION = 'ShippingConfirmation';
    case CUSTOMER_COMMUNICATION = 'CustomerCommunication';
    case REFUND_POLICY = 'RefundPolicy';
    case CANCELLATION_POLICY = 'CancellationPolicy';
    case RECURRING_PAYMENT_AGREEMENT = 'RecurringPaymentAgreement';
    case UNCATEGORIZED = 'Uncategorised';
}
