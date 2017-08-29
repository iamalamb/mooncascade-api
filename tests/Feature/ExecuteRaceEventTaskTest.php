<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExecuteRaceEventTaskTest extends TestCase
{

    protected $configuration;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->configuration = config('mooncascade');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRaceEventTaskExecutesCorrectly()
    {
        $this->artisan('mooncascade:execute:race');


    }
}
