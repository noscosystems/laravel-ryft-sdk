<?php

namespace Nosco\Ryft\Enums\Accounts;

use Illuminate\Support\Collection;

enum AccountDocumentCategory: string
{
    case AUTHORIZATION = 'Authorization';
    case PROOF_OF_ADDRESS = 'ProofOfAddress';
    case PROOF_OF_BUSINESS = 'ProofOfBusiness';
    case PROOF_OF_IDENTITY = 'ProofOfIdentity';

    public function documentTypes(): Collection
    {
        return match ($this) {
            self::AUTHORIZATION => AccountDocumentType::authorization(),
            self::PROOF_OF_ADDRESS => AccountDocumentType::proofOfAddress(),
            self::PROOF_OF_BUSINESS => AccountDocumentType::proofOfBusiness(),
            self::PROOF_OF_IDENTITY => AccountDocumentType::proofOfIdentity(),
        };
    }
}
