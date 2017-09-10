<?php

namespace Tests\Feature;

use Mooncascade\Contracts\Managers\MooncascadeEventManager;
use Mooncascade\Contracts\Managers\MooncascadeFCMManager;
use Tests\TestCase;

/**
 * Class MooncascadeServiceProviderTest
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class MooncascadeServiceProviderTest extends TestCase
{
    /**
     * General test to ensure that all services are eventually
     * resolved correctly.
     *
     * @dataProvider dataProvider
     * @return void
     */
    public function testAppResolutionWorksCorrectly($class, $key)
    {
        $manager = $this->app->make($class);

        $this->assertInstanceOf(config($key), $manager);
    }

    /**
     * @return array
     */
    public function dataProvider(): array
    {
        return [
            [
                MooncascadeEventManager::class,
                'mooncascade.managers.event_manager'
            ],
            [
                MooncascadeFCMManager::class,
                'mooncascade.managers.fcm_manager'
            ]
        ];
    }
}
