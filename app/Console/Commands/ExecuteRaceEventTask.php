<?php

namespace Mooncascade\Console\Commands;

use Illuminate\Console\Command;
use Mooncascade\Contracts\Managers\MooncascadeEventManager;

class ExecuteRaceEventTask extends Command
{
    /**
     * @var MooncascadeEventManager
     */
    protected $eventManager;


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mooncascade:event:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to run the test race';

    /**
     * ExecuteRaceEventTask constructor.
     * @param MooncascadeEventManager $eventManager
     */
    public function __construct(MooncascadeEventManager $eventManager)
    {
        parent::__construct();

        $this->eventManager = $eventManager;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->handleSetup();

        $this->info('Starting the event...');
        $this->eventManager->execute();
    }

    public function handleSetup()
    {
        $this->call('mooncascade:event:setup');
    }
}
