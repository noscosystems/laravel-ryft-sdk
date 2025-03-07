<?php

namespace Nosco\Ryft\Requests\Disputes;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * disputeGetById.
 *
 * This is used to fetch a dispute by its unique Id
 */
class DisputeGetById extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/disputes/{$this->disputeId}";
    }

    /**
     * @param string $disputeId Dispute to retrieve
     */
    public function __construct(
        protected string $disputeId,
    ) {}
}
