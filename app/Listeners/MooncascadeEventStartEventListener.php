<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Log;
use Mooncascade\Events\MooncascadeEventStartEvent;
use Mooncascade\Strategies\AthleteRetrievalStrategy;

class MooncascadeEventStartEventListener extends AbstractLoggableEventListener
{
    /**
     * @var AthleteRetrievalStrategy
     */
    protected $athleteRetrievalStrategy;

    /**
     * AbstractLoggableEventListener constructor.
     * @param Log $logger
     */
    public function __construct(Log $logger, AthleteRetrievalStrategy $athleteRetrievalStrategy)
    {
        parent::__construct($logger);

        $this->athleteRetrievalStrategy = $athleteRetrievalStrategy;
    }

    /**
     * Handle the event.
     *
     * @param  MooncascadeEventStartEvent  $event
     * @return void
     */
    public function handle(MooncascadeEventStartEvent $event)
    {
        $message = 'Event has now started';
        $this->logMessage($message);

        $this->athleteRetrievalStrategy->execute();
    }
}
