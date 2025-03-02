<?php

namespace RapidCMS\Core\Commands;

use Illuminate\Console\Command;

class RapidCMSCommand extends Command
{
    public $signature = 'core';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
