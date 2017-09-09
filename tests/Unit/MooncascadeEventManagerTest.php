<?php

namespace Tests\Unit;

use Mooncascade\Events\MooncascadeDelayedStartEvent;
use Mooncascade\Events\MooncascadeEventStartEvent;
use Tests\TestCase;
use Mooncascade\Managers\MooncascadeEventManager;
use Illuminate\Support\Facades\Event;

class MooncascadeEventManagerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoonCascadeExecutesWithDelay()
    {
        Event::fake();

        $time = 2;
        $manager = new MooncascadeEventManager(true, $time);
        $manager->execute();

        Event::assertDispatched(MooncascadeDelayedStartEvent::class, function($e) use ($time) {
            return $e->getDelayRaceStartTime() === $time;
        });

        Event::assertDispatched(MooncascadeEventStartEvent::class);
    }

    public function testMoonCascadeExecutesWithoutDelay()
    {
        Event::fake();

        $time = 2;
        $manager = new MooncascadeEventManager(false, $time);
        $manager->execute();

        Event::assertNotDispatched(MooncascadeDelayedStartEvent::class);
        Event::assertDispatched(MooncascadeEventStartEvent::class);
    }
}
