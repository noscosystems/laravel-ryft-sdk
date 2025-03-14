<?php

namespace Nosco\Ryft\Resource;

use Nosco\Ryft\Requests\PlatformFees\PlatformFeeGetById;
use Nosco\Ryft\Requests\PlatformFees\PlatformFeeGetList;
use Nosco\Ryft\Requests\PlatformFees\PlatformFeeGetRefunds;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class PlatformFees extends Resource
{
    /**
     * Retrieves your platform fees in sorted (by epoch) order.
     *
     * Retrieves a list of the application fees you've collected.
     *
     * They are returned in sorted (by epoch) order (default is newest first).
     *
     * @param bool|null $ascending Control the order (newest or oldest) in which the platform fees are returned. `false` will arrange the results with newest first whereas `true` shows oldest first
     *
     * @link https://api-reference.ryftpay.com/#tag/Platform-Fees/operation/platformFeeGetList Documentation
     */
    public function list(?bool $ascending = null, ?int $limit = null): Response
    {
        return $this->connector->send(new PlatformFeeGetList($ascending, $limit));
    }

    /**
     * Retrieve a platform fee by ID.
     *
     * This is used to fetch a platform fee by its `platformFeeId`.
     *
     * @param string $platformFeeId PlatformFee to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Platform-Fees/operation/platformFeeGetById Documentation
     */
    public function get(string $platformFeeId): Response
    {
        return $this->connector->send(new PlatformFeeGetById($platformFeeId));
    }

    /**
     * Retrieve platform fee refund(s).
     *
     * This is used to fetch a platform fee refunds by their `platformFeeId`
     *
     * @param string $platformFeeId PlatformFee to retrieve refunds for
     *
     * @link https://api-reference.ryftpay.com/#tag/Platform-Fees/operation/platformFeeGetRefunds Documentation
     */
    public function getRefunds(string $platformFeeId): Response
    {
        return $this->connector->send(new PlatformFeeGetRefunds($platformFeeId));
    }
}
