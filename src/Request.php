<?php

namespace Nosco\Ryft;

use Nosco\Ryft\Traits\Requests\HasAccountHeader;
use Saloon\Http\Request as SaloonRequest;

abstract class Request extends SaloonRequest
{
    use HasAccountHeader;
}
