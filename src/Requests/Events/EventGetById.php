<?php

namespace Nosco\Ryft\Requests\Events;

use Nosco\Ryft\Dtos\Events\Event;
use Nosco\Ryft\Request;
use Saloon\Enums\Method;
use Saloon\Http\Response;

/**
 * eventGetById.
 *
 * This is used to fetch an Event by its eventId
 */
class EventGetById extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return "/events/{$this->eventId}";
    }

    /**
     * @param string $eventId Event to retrieve
     */
    public function __construct(
        protected string $eventId,
    ) {}

    public function createDtoFromResponse(Response $response): ?Event
    {
        return Event::fromResponse($response);
    }
}
