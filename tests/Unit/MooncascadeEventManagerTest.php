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
     * @var MooncascadeEventManager
     */
    protected $eventManager;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();

        $this->eventManager = new MooncascadeEventManager();
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoonCascadeExecutesWithDelay()
    {
        Event::fake();

        $time = 10;

        $this->eventManager
            ->setDelayRaceStart(true)
            ->setDelayRaceStartTime($time);

        $this->eventManager->execute();

        Event::assertDispatched(MooncascadeDelayedStartEvent::class, function($e) use ($time) {
            return $e->getDelayRaceStartTime() === $time;
        });

        Event::assertDispatched(MooncascadeEventStartEvent::class);
    }

    public function testMoonCascadeExecutesWithoutDelay()
    {
        Event::fake();

        $this->eventManager
            ->setDelayRaceStart(false);

        $this->eventManager->execute();

        Event::assertNotDispatched(MooncascadeDelayedStartEvent::class);

        Event::assertDispatched(MooncascadeEventStartEvent::class);
    }
}
