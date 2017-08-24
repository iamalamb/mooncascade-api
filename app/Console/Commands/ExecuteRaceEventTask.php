<?php

namespace Mooncascade\Console\Commands;

use Illuminate\Console\Command;
use Mooncascade\Managers\MooncascadeEventManagerInterface;

class ExecuteRaceEventTask extends Command
{
    /**
     * @var MooncascadeEventManagerInterface
     */
    protected $eventManager;



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
     * @param MooncascadeEventManagerInterface $eventManager
     */
//    public function __construct(MooncascadeEventManagerInterface $eventManager)
//    {
//        parent::__construct();
//
//        $this->eventManager = $eventManager;
//    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $this->eventManager->execute();
    }
}
