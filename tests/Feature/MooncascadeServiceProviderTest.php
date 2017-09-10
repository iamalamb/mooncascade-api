<?php

namespace Tests\Feature;

use Mooncascade\Contracts\Managers\MooncascadeEventManager;
use Tests\TestCase;

/**
 * Class MooncascadeServiceProviderTest
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class MooncascadeServiceProviderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @dataProvider dataProvider
     * @return void
     */
    public function testExample($class, $key)
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
            ]
        ];
    }
}
