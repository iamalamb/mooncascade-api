<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventRegistrationControllerTest extends TestCase
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
     * Test to ensure validation functions correctly
     *
     * @return void
     */
    public function testPostActionValidation()
    {
        $url = '/api/register';

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
        $response = $this->json(
            'POST',
            $url,
            [
                'uuid' => 123,
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJson(
                [
                    'uuid' => ['The uuid must be a string.'],
                ]
            );

        // Submit an invalid request
        $response = $this->json(
            'POST',
            $url,
            [
                'uuid' => 'asdfasdfasdfasdf',
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJson(
                [
                    'uuid' => ['The uuid must be 28 characters.'],
                ]
            );
    }

    /**
     * Test to ensure that the post action
     * executes correctly if validation is passed.
     */
    public function testPostAction()
    {
        $url = '/api/register';

        // Submit an invalid request
        $response = $this->json(
            'POST',
            $url,
            [
                'uuid' => 'I2ujbMcWMIhu4Ke8BvjXucZ3kZj2',
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    'status' => true,
                ]
            );
    }
}
