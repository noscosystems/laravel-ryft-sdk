<?php

namespace Nosco\Ryft\Requests\Disputes;

use Nosco\Ryft\Dtos\Disputes\Dispute;
use Nosco\Ryft\Dtos\Disputes\DisputeEvidence;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Disputes\ReturnsDispute;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * disputeAddEvidenceById.
 *
 * Adds or updates the evidence currently attached to the dispute. Note that for file evidence, you
 * must first upload the file via our files API. Once you have attached all relevant evidence, call the
 * /challenge endpoint to submit the evidence for review. **Note:** the Dispute must be in status
 * `Open` for this operation.
 */
class DisputeAddEvidenceById extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsDispute;

    protected Method $method = Method::PATCH;

    public function resolveEndpoint(): string
    {
        return "/disputes/{$this->disputeId}/evidence";
    }

    /**
     * @param string $disputeId Dispute to attach evidence to
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
