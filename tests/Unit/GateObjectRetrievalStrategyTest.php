<?php

namespace Tests\Unit;

use LaravelDoctrine\ORM\Testing\Concerns\InteractsWithEntities;
use Mooncascade\Entities\Athlete;
use Mooncascade\Strategies\RangeCalculationStrategy;
use Tests\TestCase;

use Mooncascade\Strategies\GateObjectRetrievalStrategy;

class GateObjectRetrievalStrategyTest extends TestCase
{
    use InteractsWithEntities;

    /**
     *
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
    public function testObjectRetrievalExecuteMethod()
    {
        $params = [
            'delay_athlete_execution_min_threshold' => 2,
            'delay_athlete_execution_max_threshold' => 5,
            'batch_athlete_retrieval_min_threshold' => 1,
            'batch_athlete_retrieval_max_threshold' => 5,
        ];

        $class = Athlete::class;
        $entityManager = $this->app->make('em');

        $rangeCalculationStrategy = $this
            ->getMockBuilder(RangeCalculationStrategy::class)
            ->disableOriginalConstructor()
            ->setMethods(['execute'])
            ->getMock();

        $props = [
            'min' => $params['batch_athlete_retrieval_min_threshold'],
            'max' => $params['batch_athlete_retrieval_max_threshold'],
        ];

        $rangeCalculationStrategy
            ->expects($this->exactly(3))
            ->method('execute')
            ->with($props)
            ->willReturn(2);

        $strategy = new GateObjectRetrievalStrategy($class, $entityManager, $rangeCalculationStrategy);

        $entities = $strategy->execute($params);

        $total = $entities->count();

        $this->assertEquals(2, $total);

        $entities->each(
            function ($entity) {

                $this->assertInstanceOf(Athlete::class, $entity);
                $this->assertNotEmpty($entity->getTimeAtGate());
                $this->assertNotNull($entity->getTimeAtGate());
                $this->assertInternalType('float', $entity->getTimeAtGate());

                $this->entitiesMatch(Athlete::class, ['timeAtGate' => $entity->getTimeAtGate()], 1);
            }
        );
    }
}
