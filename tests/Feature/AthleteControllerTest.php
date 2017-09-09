<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AthleteControllerTest extends TestCase
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
    public function testAthleteControllerShowReturnsCorrectResponse()
    {
        $url = '/api/athlete/1';

        $response = $this->json('GET', $url);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'code',
                'name',
                'start_number',
                'gender' => [
                    'id',
                    'name'
                ],
                'team' => [
                    'id',
                    'name'
                ],
            ]);
    }

    public function testAthleteControllerShowReturnsCorrectErrorStatus()
    {
        $url = '/api/athlete/999999999999999';

        $response = $this->json('GET', $url);

        $response
            ->assertStatus(404);
    }
}
