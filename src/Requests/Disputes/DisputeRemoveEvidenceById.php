<?php

namespace Nosco\Ryft\Requests\Disputes;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * disputeRemoveEvidenceById.
 *
 * Removes evidence currently attached to a dispute. **Note:** the Dispute must be in status `Open` for
 * this operation.
 */
class DisputeRemoveEvidenceById extends Request
{
    protected Method $method = Method::DELETE;

    public function resolveEndpoint(): string
    {
        return "/disputes/{$this->disputeId}/evidence";
    }

    /**
     * @param string $disputeId Dispute to remove evidence from
     */
    public function __construct(
        protected string $disputeId,
    ) {}
}
