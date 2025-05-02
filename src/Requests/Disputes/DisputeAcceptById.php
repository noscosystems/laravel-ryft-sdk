<?php

namespace Nosco\Ryft\Requests\Disputes;

use Nosco\Ryft\Dtos\Disputes\Dispute;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Disputes\ReturnsDispute;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * disputeAcceptById.
 *
 * Accepts a specific dispute by Id. Typically you should use this if the dispute is in fact legitimate
 * and you are accepting the financial impact. **Note** that this operation cannot be done.
 */
class DisputeAcceptById extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsDispute;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/disputes/{$this->disputeId}/accept";
    }

    /**
     * @param string $disputeId Dispute to accept
     */
    public function __construct(
        protected string $disputeId,
    ) {}
}
