<?php

namespace Nosco\Ryft\Commands;

use Illuminate\Console\Command;

class RyftCommand extends Command
{
    public $signature = 'ryft';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
