<?php

namespace Nosco\Ryft\Resource;

use DateTimeInterface;
use Illuminate\Support\Collection;
use Nosco\Ryft\Dtos\Disputes\Dispute;
use Nosco\Ryft\Dtos\Disputes\DisputeEvidence;
use Nosco\Ryft\Requests\Disputes\DisputeAcceptById;
use Nosco\Ryft\Requests\Disputes\DisputeAddEvidenceById;
use Nosco\Ryft\Requests\Disputes\DisputeChallengeById;
use Nosco\Ryft\Requests\Disputes\DisputeGetById;
use Nosco\Ryft\Requests\Disputes\DisputeRemoveEvidenceById;
use Nosco\Ryft\Requests\Disputes\DisputesList;
use Nosco\Ryft\Resource;
use Saloon\Http\Response;

class Disputes extends Resource
{
    /**
     * @param DateTimeInterface|null $startTimestamp The start timestamp (inclusive), it must be before the endTimestamp.
     * @param DateTimeInterface|null $endTimestamp   The timestamp when to return payment sessions up to (inclusive),
     *                                               it must be after the startTimestamp.
     * @param bool|null              $ascending      Control the order (newest or oldest) in which the disputes are returned.
     *                                               `false` will arrange the results with newest first,
     *                                               whereas `true` shows oldest first. The default is `false`.
     * @param int|null               $limit          Control how many items are return in a given page
     *                                               The max limit we allow is `25`. The default is `10`.
     * @param string|null            $startsAfter    A token to identify where to resume a subsequent paginated query.
     *                                               The value of the `paginationToken` field from that response should be supplied here,
     *                                               to retrieve the next page of results for that timestamp range.
     *
     * @return Collection<Dispute>
     *
     * @throws \LogicException on request failure
     */
    public function list(
        ?DateTimeInterface $startTimestamp = null,
        ?DateTimeInterface $endTimestamp = null,
        ?bool $ascending = null,
        ?int $limit = null,
        ?string $startsAfter = null,
    ): Collection {
        $startTimestamp = $startTimestamp?->getTimestamp();
        $endTimestamp = $endTimestamp?->getTimestamp();

        return $this->connector
            ->send(new DisputesList($startTimestamp, $endTimestamp, $ascending, $limit, $startsAfter))
            ->dtoOrFail();
    }

    /**
     * @param string $disputeId Dispute to retrieve
     *
     * @throws \LogicException on request failure
     */
    public function get(string $disputeId): Dispute
    {
        return $this->connector
            ->send(new DisputeGetById($disputeId))
            ->dtoOrFail();
    }

    /**
     * @param string $disputeId Dispute to accept
     *
     * @throws \LogicException on request failure
     */
    public function accept(string $disputeId): Dispute
    {
        return $this->connector
            ->send(new DisputeAcceptById($disputeId))
            ->dtoOrFail();
    }

    /**
     * @param string $disputeId Dispute to remove evidence from
     *
     * @throws \LogicException on request failure
     */
    public function removeEvidence(string $disputeId, DisputeEvidence $evidence): Dispute
    {
        return $this->connector
            ->send(new DisputeRemoveEvidenceById($disputeId, $evidence))
            ->dtoOrFail();
    }

    /**
     * @param string $disputeId Dispute to attach evidence to
     *
     * @throws \LogicException on request failure
     */
    public function addEvidence(string $disputeId, DisputeEvidence $evidence): Dispute
    {
        return $this->connector
            ->send(new DisputeAddEvidenceById($disputeId, $evidence))
            ->dtoOrFail();
    }

    /**
     * @param string $disputeId Dispute to challenge
     *
     * @throws \LogicException on request failure
     */
    public function challenge(string $disputeId): Dispute
    {
        return $this->connector
            ->send(new DisputeChallengeById($disputeId))
            ->dtoOrFail();
    }
}
