<?php

namespace Tests\Feature;

use LaravelDoctrine\ORM\Testing\Concerns\InteractsWithEntities;
use Mooncascade\Entities\Athlete;
use Mooncascade\Events\MooncascadeBatchRetrievalEvent;
use Mooncascade\Repositories\AthleteRepository;
use Mooncascade\Strategies\AthleteRetrievalStrategy;
use Tests\TestCase;

class AthleteRetrievalStrategyTest extends TestCase
{
    use InteractsWithEntities;

    /**
     * @var AthleteRepository
     */
    protected $repository;

    /**
     * @var AthleteRetrievalStrategy
     */
    protected $strategy;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->app
            ->make('Doctrine\ORM\EntityManagerInterface')
            ->getRepository(Athlete::class);

        $this->strategy = $this->app->make(AthleteRetrievalStrategy::class);

        $this->artisan('doctrine:migrations:refresh');
        $this->seed();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAthleteRetrievalStrategyExecuteFunction()
    {
        // First assert that no entities have been updated
        $totalAthletes = $this->repository->getCount();
        $totalUpdatedAthletes = $this->repository->getCount(['timeAtGate' => null]);

        $this->assertNotEquals(0, $totalAthletes);
        $this->assertEquals($totalAthletes, $totalUpdatedAthletes);

        // Call the execute function
        $this->strategy->execute();

        $this->noEntitiesMatch(Athlete::class, ['timeAtGate' => NULL]);
    }
}
