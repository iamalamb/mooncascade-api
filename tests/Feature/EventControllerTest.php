<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventControllerTest extends TestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->artisan('doctrine:migrations:refresh');
        $this->seed();
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPostActionValidation()
    {
        $url = '/api/event';

        // Submit an invalid request
        $response = $this->json('POST', $url);

        $response
            ->assertStatus(422)
            ->assertJson(
                [
                    'uuid' => ['The uuid field is required.'],
                ]
            );

        // Submit an invalid request
        $response = $this->json('POST', $url, [
            'uuid' => 123
        ]);

        $response
            ->assertStatus(422)
            ->assertJson(
                [
                    'uuid' => ['The uuid must be a string.'],
                ]
            );

        // Submit an invalid request
        $response = $this->json('POST', $url, [
            'uuid' => 'asdfasdfasdfasdf'
        ]);

        $response
            ->assertStatus(422)
            ->assertJson(
                [
                    'uuid' => ['The uuid must be 28 characters.'],
                ]
            );
    }
}
