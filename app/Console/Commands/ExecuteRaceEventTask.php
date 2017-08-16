<?php

namespace Mooncascade\Console\Commands;

use Illuminate\Console\Command;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Entities\Athlete;

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
        $repository = EntityManager::getRepository(Athlete::class);

        $count = $repository->getCount();
        $this->info($count);
    }
}
