<?php

declare(strict_types=1);

namespace App\Schedule;

use App\Message\Bar;
use App\Message\Foo;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Contracts\Cache\CacheInterface;

#[AsSchedule]
class DefaultScheduleProvider implements ScheduleProviderInterface
{
    public function __construct(
        private readonly CacheInterface $cache,
        private readonly LockFactory $lockFactory,
    ) {
    }

    public function getSchedule(): Schedule
    {
        return (new Schedule())
            ->add(RecurringMessage::every('20 seconds', new Foo()))
            ->add(RecurringMessage::every('40 seconds', new Bar()))
            ->stateful($this->cache)
            ->lock($this->lockFactory->createLock('foobar'));
    }
}