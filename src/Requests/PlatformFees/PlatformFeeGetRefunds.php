<?php

namespace Nosco\Ryft\Requests\PlatformFees;

use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * platformFeeGetRefunds.
 *
 * This is used to fetch a platform fee refunds by their platformFeeId
 */
class PlatformFeeGetRefunds extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/platform-fees/{$this->platformFeeId}/refunds";
    }

    /**
     * @param string $platformFeeId PlatformFee to retrieve refunds for
     */
    public function __construct(
        protected string $platformFeeId,
    ) {}
}
