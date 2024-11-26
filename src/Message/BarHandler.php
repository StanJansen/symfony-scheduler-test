<?php

declare(strict_types=1);

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class BarHandler
{
    public function __invoke(Bar $message): void
    {
        var_dump('BAR');
    }
}