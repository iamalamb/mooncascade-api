<?php

namespace Mooncascade\Console\Commands;

use Illuminate\Console\Command;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Entities\Athlete;
use Illuminate\Contracts\Config\Repository;
use Faker\Generator;
use Mooncascade\Threads\RaceExecutionThread;

class ExecuteRaceEventTask extends Command
{
    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var Generator
     */
    protected $faker;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mooncascade:execute:race';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to run the test race';

    /**
     * ExecuteRaceEventTask constructor.
     * @param Repository $config
     */
    public function __construct(Repository $config, Generator $faker)
    {
        parent::__construct();

        $this->config = $config;
        $this->faker = $faker;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->checkDelayExecution();

        $worker = new \Worker();
        $worker->start();

        $repository = EntityManager::getRepository(Athlete::class);

        $entities = $repository->findBy(['timeAtGate' => null]);

        foreach ($entities as $entity) {

            $thread = new RaceExecutionThread($this->config, $this->faker);
            $thread->setAthlete($entity);

            $worker->stack($thread);
        }

        while($worker->collect()){}

        $worker->shutdown();

        $message = 'Event complete';
        $this->info($message);
    }
}
