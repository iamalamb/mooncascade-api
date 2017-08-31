<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Mooncascade\Events\MooncascadeAthleteEventInterface;
use Mooncascade\Handlers\BatchEntityCollectionHandler;

/**
 * Class AbstractMooncascadeAthleteEventListener
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractMooncascadeAthleteEventListener
{
    /**
     * @var Collection
     */
    protected $allowedStrategies;

    /**
     * @var BatchEntityCollectionHandler
     */
    protected $batchEntityCollectionHandler;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $property;


    /**
     * AbstractMooncascadeAthleteEventListener constructor.
     * @param BatchEntityCollectionHandler $batchEntityCollectionHandler
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        BatchEntityCollectionHandler $batchEntityCollectionHandler,
        EntityManagerInterface $entityManager
    ) {
        $this->batchEntityCollectionHandler = $batchEntityCollectionHandler;
        $this->entityManager = $entityManager;

        $this->batchEntityCollectionHandler->setProperty($this->property);
        /*
         * Set the allowed strategies that
         * can be used to calculate time
         */
        $this->batchEntityCollectionHandler
            ->getRandomRaceStrategyEventGenerator()
            ->setAllowedStrategies($this->allowedStrategies);
    }

    /**
     * @param MooncascadeAthleteEventInterface $event
     */
    public function handle(MooncascadeAthleteEventInterface $event)
    {
        $entities = $event->getEntities();

        /*
         * Pass them to the batch
         * handler for processing
         */
        $this->batchEntityCollectionHandler->handle($entities);

        $this->entityManager->flush();
    }
}
