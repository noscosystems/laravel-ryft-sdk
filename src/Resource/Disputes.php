<?php

namespace Nosco\Ryft\Resource;

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
     * @param int|null    $startTimestamp The start timestamp (inclusive), it must be before the endTimestamp.
     * @param int|null    $endTimestamp   The timestamp when to return payment sessions up to (inclusive), it must be after the startTimestamp.
     * @param bool|null   $ascending      Control the order (newest or oldest) in which the disputes are returned. `false` will arrange the results with newest first, whereas `true` shows oldest first. The default is `false`.
     * @param int|null    $limit          Control how many items are return in a given page The max limit we allow is `25`. The default is `10`.
     * @param string|null $startsAfter    A token to identify where to resume a subsequent paginated query. The value of the `paginationToken` field from that response should be supplied here, to retrieve the next page of results for that timestamp range.
     */
    public function list(
        ?int $startTimestamp = null,
        ?int $endTimestamp = null,
        ?bool $ascending = null,
        ?int $limit = null,
        ?string $startsAfter = null,
    ): Response {
        return $this->connector->send(new DisputesList($startTimestamp, $endTimestamp, $ascending, $limit, $startsAfter));
    }

    /**
     * @param string $disputeId Dispute to retrieve
     */
    public function get(string $disputeId): Response
    {
        return $this->connector->send(new DisputeGetById($disputeId));
    }

    /**
     * @param string $disputeId Dispute to accept
     */
    public function accept(string $disputeId): Response
    {
        return $this->connector->send(new DisputeAcceptById($disputeId));
    }

    /**
     * @param string $disputeId Dispute to remove evidence from
     */
    public function removeEvidence(string $disputeId): Response
    {
        return $this->connector->send(new DisputeRemoveEvidenceById($disputeId));
    }

    /**
     * @param string $disputeId Dispute to attach evidence to
     */
    public function addEvidence(string $disputeId): Response
    {
        return $this->connector->send(new DisputeAddEvidenceById($disputeId));
    }

    /**
     * @param string $disputeId Dispute to challenge
     */
    public function challenge(string $disputeId): Response
    {
        return $this->connector->send(new DisputeChallengeById($disputeId));
    }
}
