<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Mooncascade\Events\MooncascadeAthleteEventInterface;
use Mooncascade\Handlers\BatchEntityCollectionHandler;

/**
 * Class MooncascadeAthleteFinishEventListener
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class MooncascadeAthleteFinishEventListener extends AbstractMooncascadeAthleteEventListener
{
    /**
     * AbstractMooncascadeAthleteEventListener constructor.
     * @param BatchEntityCollectionHandler $batchEntityCollectionHandler
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        BatchEntityCollectionHandler $batchEntityCollectionHandler,
        EntityManagerInterface $entityManager
    ) {
        $this->allowedStrategies = collect(['sequential', 'overtake', 'tie']);
        $this->property = 'timeAtFinish';

        parent::__construct($batchEntityCollectionHandler, $entityManager);
    }

    /**
     * @param MooncascadeAthleteEventInterface $event
     */
    public function handle(MooncascadeAthleteEventInterface $event)
    {
        parent::handle($event);
    }
}
