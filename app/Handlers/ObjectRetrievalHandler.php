<?php

namespace Mooncascade\Handlers;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Mooncascade\Generators\RandomIntegerGenerator;
use Mooncascade\Generators\RandomRaceStrategyEventGenerator;

/**
 * Class ObjectRetrievalHandler
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class ObjectRetrievalHandler
{
    /**
     * @var EntityManager
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
     * @var RandomRaceStrategyEventGenerator
     */
    protected $randomRaceStrategyEventGenerator;

    /**
     * @var ObjectRepository
     */
    protected $repository;

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     * @return ObjectRetrievalHandler
     */
    public function setEntityManager(EntityManager $entityManager): ObjectRetrievalHandler
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
     * @return ObjectRetrievalHandler
     */
    public function setMin(int $min): ObjectRetrievalHandler
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
     * @return ObjectRetrievalHandler
     */
    public function setMax(int $max): ObjectRetrievalHandler
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
     * @return ObjectRetrievalHandler
     */
    public function setRandomIntegerGenerator(RandomIntegerGenerator $randomIntegerGenerator): ObjectRetrievalHandler
    {
        $this->randomIntegerGenerator = $randomIntegerGenerator;

        return $this;
    }

    /**
     * @return RandomRaceStrategyEventGenerator
     */
    public function getRandomRaceStrategyEventGenerator(): RandomRaceStrategyEventGenerator
    {
        return $this->randomRaceStrategyEventGenerator;
    }

    /**
     * @param RandomRaceStrategyEventGenerator $randomRaceStrategyEventGenerator
     * @return ObjectRetrievalHandler
     */
    public function setRandomRaceStrategyEventGenerator(
        RandomRaceStrategyEventGenerator $randomRaceStrategyEventGenerator
    ): ObjectRetrievalHandler {
        $this->randomRaceStrategyEventGenerator = $randomRaceStrategyEventGenerator;

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
     * @return ObjectRetrievalHandler
     */
    public function setRepository(ObjectRepository $repository): ObjectRetrievalHandler
    {
        $this->repository = $repository;

        return $this;
    }
}
