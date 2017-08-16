<?php

namespace Mooncascade\Console\Commands;

use Faker\Provider\DateTime;
use Illuminate\Console\Command;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Entities\Athlete;
use Carbon\Carbon;

class ExecuteRaceEventTask extends Command
{
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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->handleTimeAtGate();

        $repository = EntityManager::getRepository(Athlete::class);
        $entities = collect($repository->findAll());

        if ($entities->count()) {

            $entities->each(
                function ($entity) {

                    $date = Carbon::createFromFormat('U.u', $entity->getTimeAtGate());
                    $info = $entity->getStartNumber() . ': ' . $entity->getName() . ' - ' . $entity->getTimeAtGate();

                    $this->info($info);
                }
            );

        }
    }

    private function handleTimeAtGate()
    {

        $repository = EntityManager::getRepository(Athlete::class);

        $entities = collect($repository->findBy(['timeAtGate' => null]));

        if ($entities->count()) {

            $entities->each(
                function ($entity) {

                    $entity->setTimeAtGate(microtime(true));

                    EntityManager::persist($entity);
                    EntityManager::flush();
                }
            );

            $this->handleTimeAtGate();

        }
    }
}
