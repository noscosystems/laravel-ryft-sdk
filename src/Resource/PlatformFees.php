<?php

namespace Nosco\Ryft\Resource;

use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\PlatformFees\PlatformFee;
use Nosco\Ryft\Dtos\PlatformFees\PlatformFeeRefund;
use Nosco\Ryft\Requests\PlatformFees\PlatformFeeGetById;
use Nosco\Ryft\Requests\PlatformFees\PlatformFeeGetList;
use Nosco\Ryft\Requests\PlatformFees\PlatformFeeGetRefunds;
use Nosco\Ryft\Resource;

class PlatformFees extends Resource
{
    /**
     * Retrieves your platform fees in sorted (by epoch) order.
     *
     * Retrieves a list of the application fees you've collected.
     *
     * They are returned in sorted (by epoch) order (default is newest first).
     *
     * @param bool|null $ascending Control the order (newest or oldest) in which the platform fees are returned.
     *                             `false` will arrange the results with newest first whereas `true` shows oldest first
     *
     * @return Collection<PlatformFee>
     *
     * @link https://api-reference.ryftpay.com/#tag/Platform-Fees/operation/platformFeeGetList Documentation
     *
     * @throws \LogicException on request failure
     */
    public function list(?bool $ascending = null, ?int $limit = null): Collection
    {
        return $this->connector
            ->send(new PlatformFeeGetList($ascending, $limit))
            ->dtoOrFail();
    }

    /**
     * Retrieve a platform fee by ID.
     *
     * This is used to fetch a platform fee by its `platformFeeId`.
     *
     * @param string $platformFeeId PlatformFee to retrieve
     *
     * @link https://api-reference.ryftpay.com/#tag/Platform-Fees/operation/platformFeeGetById Documentation
     *
     * @throws \LogicException on request failure
     */
    public function get(string $platformFeeId): PlatformFee
    {
        return $this->connector
            ->send(new PlatformFeeGetById($platformFeeId))
            ->dtoOrFail();
    }

    /**
     * Retrieve platform fee refund(s).
     *
     * This is used to fetch a platform fee refunds by their `platformFeeId`
     *
     * @param string $platformFeeId PlatformFee to retrieve refunds for
     *
     * @return Collection<PlatformFeeRefund>
     *
     * @link https://api-reference.ryftpay.com/#tag/Platform-Fees/operation/platformFeeGetRefunds Documentation
     *
     * @throws \LogicException on request failure
     */
    public function getRefunds(string $platformFeeId): Collection
    {
        return $this->connector
            ->send(new PlatformFeeGetRefunds($platformFeeId))
            ->dtoOrFail();
    }
}
