<?php

declare(strict_types=1);

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FooHandler
{
    public function __invoke(Foo $message): void
    {
        sleep(10);
        var_dump('FOO');
    }
}