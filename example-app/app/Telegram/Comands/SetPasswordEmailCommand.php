<?php

namespace App\Telegram\Commands;

use DefStudio\Telegraph\Commands\Command;
use App\Telegram\Handler;

class SetPasswordEmailCommand extends Command
{
    protected string $name = 'setpasswordemail';
    protected string $description = 'Set your email password';

    public function execute(Handler $handler)
    {
        $handler->setpasswordemail();
    }
}

