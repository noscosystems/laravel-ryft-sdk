<?php

namespace Nosco\Ryft\Requests\PlatformFees;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\PlatformFees\PlatformFeeRefund;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;
use Saloon\Http\Response;

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

    public function createDtoFromResponse(Response $response): Collection
    {
        return PlatformFeeRefund::fromPaginatedResponse($response);
    }
}
