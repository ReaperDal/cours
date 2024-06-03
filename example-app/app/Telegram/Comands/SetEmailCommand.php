<?php

namespace App\Telegram\Commands;

use DefStudio\Telegraph\Commands\Command;
use App\Telegram\Handler;

class SetEmailCommand extends Command
{
    protected string $name = 'setemail';
    protected string $description = 'Set your email address';

    public function execute(Handler $handler)
    {
        $handler->setemail();
    }
}


