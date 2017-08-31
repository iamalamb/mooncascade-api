<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Mooncascade\Events\MooncascadeAthleteEventInterface;
use Mooncascade\Events\MooncascadeAthleteFinishEvent;
use Mooncascade\Handlers\BatchEntityCollectionHandler;

class MooncascadeAthleteGateEventListener extends AbstractMooncascadeAthleteEventListener
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

        $this->allowedStrategies = collect(['sequential', 'tie']);
        $this->property = 'timeAtGate';

        parent::__construct($batchEntityCollectionHandler, $entityManager);
    }

    /**
     * @param MooncascadeAthleteEventInterface $event
     */
    public function handle(MooncascadeAthleteEventInterface $event)
    {
        parent::handle($event);

        $entities = $event->getEntities();

        $event = new MooncascadeAthleteFinishEvent();
        $event->setEntities($entities);

        event($event);
    }
}
