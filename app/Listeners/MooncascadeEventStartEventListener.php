<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MoonscadeBaseEventInterface;
use Mooncascade\Managers\MooncascadeFCMManager;
use Mooncascade\Strategies\AthleteRetrievalStrategy;

class MooncascadeEventStartEventListener extends AbstractFCMEventListener
{
    protected $key = 'event-start';

    /**
     * @var AthleteRetrievalStrategy
     */
    protected $athleteRetrievalStrategy;

    /**
     * AbstractFCMEventListener constructor.
     * @param MooncascadeFCMManager $mooncascadeFCMManager
     */
    public function __construct(MooncascadeFCMManager $mooncascadeFCMManager, AthleteRetrievalStrategy $athleteRetrievalStrategy)
    {
        parent::__construct($mooncascadeFCMManager);

        $this->athleteRetrievalStrategy = $athleteRetrievalStrategy;
    }

    /**
     * @param MoonscadeBaseEventInterface $event
     */
    public function handle(MoonscadeBaseEventInterface $event)
    {
        parent::handle($event);

        $this->athleteRetrievalStrategy->execute();
    }
}
