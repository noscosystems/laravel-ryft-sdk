<?php

namespace Nosco\Ryft\Requests\PlatformFees;

use Nosco\Ryft\Request;
use Saloon\Enums\Method;

/**
 * platformFeeGetById.
 *
 * This is used to fetch a platform fee by its platformFeeId
 */
class PlatformFeeGetById extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/platform-fees/{$this->platformFeeId}";
    }

    /**
     * @param string $platformFeeId PlatformFee to retrieve
     */
    public function __construct(
        protected string $platformFeeId,
    ) {}
}
