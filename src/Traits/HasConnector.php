<?php

namespace Nosco\Ryft\Traits;

use Nosco\Ryft\RyftConnector;

trait HasConnector
{
    private ?RyftConnector $connector = null;

    public function connector(): RyftConnector
    {
        return $this->connector ??= new RyftConnector;
    }
}
