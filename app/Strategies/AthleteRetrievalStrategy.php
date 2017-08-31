<?php

namespace Mooncascade\Strategies;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Collection;
use Mooncascade\Generators\RandomIntegerGenerator;
use Mooncascade\Handlers\BatchEntityCollectionHandler;

/**
 * Class AthleteRetrievalStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class AthleteRetrievalStrategy implements StrategyInterface
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
     * @var integer
     */
    protected $min;

    /**
     * @var integer
     */
    protected $max;

    /**
     * @var RandomIntegerGenerator
     */
    protected $randomIntegerGenerator;

    /**
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * @return Collection
     */
    public function getAllowedStrategies(): Collection
    {
        return $this->allowedStrategies;
    }

    /**
     * @param Collection $allowedStrategies
     * @return AthleteRetrievalStrategy
     */
    public function setAllowedStrategies(Collection $allowedStrategies): AthleteRetrievalStrategy
    {
        $this->allowedStrategies = $allowedStrategies;

        return $this;
    }

    /**
     * @return BatchEntityCollectionHandler
     */
    public function getBatchEntityCollectionHandler(): BatchEntityCollectionHandler
    {
        return $this->batchEntityCollectionHandler;
    }

    /**
     * @param BatchEntityCollectionHandler $batchEntityCollectionHandler
     * @return AthleteRetrievalStrategy
     */
    public function setBatchEntityCollectionHandler(BatchEntityCollectionHandler $batchEntityCollectionHandler
    ): AthleteRetrievalStrategy {
        $this->batchEntityCollectionHandler = $batchEntityCollectionHandler;

        return $this;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return AthleteRetrievalStrategy
     */
    public function setEntityManager(EntityManagerInterface $entityManager): AthleteRetrievalStrategy
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->min;
    }

    /**
     * @param int $min
     * @return AthleteRetrievalStrategy
     */
    public function setMin(int $min): AthleteRetrievalStrategy
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $max
     * @return AthleteRetrievalStrategy
     */
    public function setMax(int $max): AthleteRetrievalStrategy
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @return RandomIntegerGenerator
     */
    public function getRandomIntegerGenerator(): RandomIntegerGenerator
    {
        return $this->randomIntegerGenerator;
    }

    /**
     * @param RandomIntegerGenerator $randomIntegerGenerator
     * @return AthleteRetrievalStrategy
     */
    public function setRandomIntegerGenerator(RandomIntegerGenerator $randomIntegerGenerator): AthleteRetrievalStrategy
    {
        $this->randomIntegerGenerator = $randomIntegerGenerator;

        return $this;
    }

    /**
     * @return ObjectRepository
     */
    public function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @param ObjectRepository $repository
     * @return AthleteRetrievalStrategy
     */
    public function setRepository(ObjectRepository $repository): AthleteRetrievalStrategy
    {
        $this->repository = $repository;

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function execute()
    {
        $this->batchEntityCollectionHandler->setProperty('timeAtGate');

        /*
         * Set the allowed strategies that
         * can be used to calculate time
         */
        $this->batchEntityCollectionHandler
            ->getRandomRaceStrategyEventGenerator()
            ->setAllowedStrategies($this->allowedStrategies);

        /*
         * Get a random limit
         */
        $this->randomIntegerGenerator
            ->setMin($this->min)
            ->setMax($this->max);

        $limit = $this->randomIntegerGenerator->generate();

        $criteria = [
            'timeAtGate' => null,
        ];

        $execute = true;

        /*
         * While there are entities
         * to retrieve keep fetching them
         */
        while ($execute) {

            $entities = collect($this->repository->findBy($criteria, null, $limit));

            if ($entities->count()) {

                /*
                 * Pass them to the batch
                 * handler for processing
                 */
                $this->batchEntityCollectionHandler->handle($entities);

                $this->entityManager->flush();

            } else {

                $execute = false;
            }

        }
    }
}
