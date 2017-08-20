<?php

namespace Tests\Unit;

use Mooncascade\Builders\MooncascadeEventBuilder;
use Mooncascade\Managers\MooncascadeEventManager;
use Mooncascade\Managers\MooncascadeEventManagerInterface;
use Tests\TestCase;
use Mooncascade\Builders\MooncascadeEventBuilderInterface;

class MooncascadeEventBuilderTest extends TestCase
{
    /**
     * @var MooncascadeEventBuilderInterface
     */
    protected $builder;

    /**
     * Setup method called before execution of each test
     */
    protected function setUp()
    {
        parent::setUp();

        $eventManager = $this->createMock(MooncascadeEventManager::class);
        $this->builder = new MooncascadeEventBuilder($eventManager);
    }


    /**
     * Assert that the EventBuilder will return
     * a valid manager
     *
     * @return void
     */
    public function testEventBuilderReturnsValidManager()
    {
        $this->assertInstanceOf(MooncascadeEventManagerInterface::class, $this->builder->getEventManager());
        $this->assertInstanceOf(MooncascadeEventManager::class, $this->builder->getEventManager());
    }
}
