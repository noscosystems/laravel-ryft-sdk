<?php

namespace Nosco\Ryft\Requests\Disputes;

use Nosco\Ryft\Dtos\Disputes\Dispute;
use Nosco\Ryft\Dtos\Disputes\DisputeEvidence;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Disputes\ReturnsDispute;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * disputeRemoveEvidenceById.
 *
 * Removes evidence currently attached to a dispute. **Note:** the Dispute must be in status `Open` for
 * this operation.
 */
class DisputeRemoveEvidenceById extends Request
{
    use HasJsonBody;
    use ReturnsDispute;

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
        protected DisputeEvidence $evidence,
    ) {}

    protected function defaultBody(): array
    {
        return $this->evidence->toArray();
    }
}
