<?php

namespace Nosco\Ryft\Requests\Disputes;

use Nosco\Ryft\Dtos\Disputes\Dispute;
use Nosco\Ryft\Request;
use Nosco\Ryft\Traits\Requests\Disputes\ReturnsDispute;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

/**
 * disputeChallengeById.
 *
 * Challenges a specific dispute. You should call this endpoint once you have attached all the relevant
 * evidence. **Note** that you can no longer submit further evidence once challenged, so make sure you
 * have gathered as much as possible to ensure a better chance of winning the dispute.
 */
class DisputeChallengeById extends Request implements HasBody
{
    use HasJsonBody;
    use ReturnsDispute;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return "/disputes/{$this->disputeId}/challenge";
    }

    /**
     * @param string $disputeId Dispute to challenge
     */
    public function __construct(
        protected string $disputeId,
    ) {}
}
