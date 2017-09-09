<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class RestControllerTest
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RestControllerTest extends TestCase
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
     * @dataProvider responseProvider
     * @return void
     */
    public function testShowActionReturnsValidResponse(string $baseUrl, array $jsonStructure)
    {
        $url = '/api/'.$baseUrl;

        $response = $this->json('GET', $url . '1');

        $response
            ->assertStatus(200)
            ->assertJsonStructure($jsonStructure);

        $response = $this->json('GET', $url . 'asdfasdfasdfa');

        $response
            ->assertStatus(404);
    }

    /**
     * DataProvider used to test the various RestController instances
     *
     * @return array
     */
    public function responseProvider(): array
    {
        return [
            [
                'athlete/',
                [
                    'id',
                    'code',
                    'name',
                    'start_number',
                    'gender' => [
                        'id',
                        'name',
                    ],
                    'team'   => [
                        'id',
                        'name',
                    ],
                ],
            ],
            [
                'team/',
                [
                    'id',
                    'name',
                    'athletes',
                ],
            ]
        ];
    }
}
