<?php

namespace Mooncascade\Strategies;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Mooncascade\Contracts\Strategies\Strategy;
use Mooncascade\Events\MooncascadeAthleteGateEvent;
use Mooncascade\Generators\RandomIntegerGenerator;
use Mooncascade\Handlers\BatchEntityCollectionHandler;

/**
 * Class AthleteRetrievalStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class AthleteRetrievalStrategy implements Strategy
{
    /**
     * @var BatchEntityCollectionHandler
     */
    protected $batchEntityCollectionHandler;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var integer
     */
    protected $min;

    /**
     * @var integer
     */
    protected $max;

    /**
     * @var string
     */
    protected $property;

    /**
     * @var RandomIntegerGenerator
     */
    protected $randomIntegerGenerator;

    /**
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * AthleteRetrievalStrategy constructor.
     * @param BatchEntityCollectionHandler $batchEntityCollectionHandler
     * @param EntityManagerInterface $entityManager
     * @param int $min
     * @param int $max
     * @param string $property
     * @param RandomIntegerGenerator $randomIntegerGenerator
     * @param ObjectRepository $repository
     */
    public function __construct(
        BatchEntityCollectionHandler $batchEntityCollectionHandler,
        EntityManagerInterface $entityManager,
        $min,
        $max,
        $property,
        RandomIntegerGenerator $randomIntegerGenerator,
        ObjectRepository $repository
    ) {
        $this->batchEntityCollectionHandler = $batchEntityCollectionHandler;
        $this->entityManager = $entityManager;
        $this->min = $min;
        $this->max = $max;
        $this->property = $property;
        $this->randomIntegerGenerator = $randomIntegerGenerator;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $criteria = [
            $this->property => null,
        ];

        $execute = true;

        /*
         * While there are entities
         * to retrieve keep fetching them
         */
        while ($execute) {

            /*
            * Get a random limit
            */
            $this->randomIntegerGenerator
                ->setMin($this->min)
                ->setMax($this->max);

            $limit = $this->randomIntegerGenerator->generate();

            $entities = collect($this->repository->findBy($criteria, null, $limit));

            if ($entities->count()) {

                $event = new MooncascadeAthleteGateEvent();
                $event->setEntities($entities);

                event($event);

            } else {

                $execute = false;
            }

        }
    }
}
