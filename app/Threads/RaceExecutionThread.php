<?php

namespace Mooncascade\Threads;

use Mooncascade\Entities\Athlete;
use Illuminate\Contracts\Config\Repository;
use Faker\Generator;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class RaceExecutionThread
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RaceExecutionThread extends \Threaded
{

    /**
     * @var Athlete
     */
    private $athlete;

    /**
     * @var Repository
     */
    private $config;

    /**
     * @var Generator
     */
    private $faker;

    /**
     * RaceExecutionThread constructor.
     *
     * @param Repository $config
     * @param Generator $faker
     */
    public function __construct(Repository $config, Generator $faker)
    {
        $this->config = $config;
        $this->faker = $faker;
    }

    /**
     * @return Athlete
     */
    public function getAthlete()
    {
        return $this->athlete;
    }

    /**
     * @param Athlete $athlete
     */
    public function setAthlete($athlete)
    {
        $this->athlete = $athlete;
    }


    /**
     *
     */
    public function run()
    {
        $this->checkDelayAthlete();
        $this->athlete->setTimeAtGate(microtime(true));
        $this->checkDelayAthlete();
        $this->athlete->setTimeAtFinish(microtime(true));

        EntityManager::persist($this->athlete);
        EntityManager::flush();
    }

    private function checkDelayAthlete()
    {
        if ($this->config->has('mooncascade.execution.delay_athlete_execution_min_threshold') && ($this->config->has(
                'mooncascade.execution.delay_athlete_execution_max_threshold'
            ))) {

            $min = $this->config->get('mooncascade.execution.delay_athlete_execution_min_threshold');
            $max = $this->config->get('mooncascade.execution.delay_athlete_execution_max_threshold');

            $time = $this->faker->numberBetween($min, $max);
            sleep($time);
        }

        return false;
    }
}
