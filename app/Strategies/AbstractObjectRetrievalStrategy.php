<?php

namespace Mooncascade\Strategies;

use Mooncascade\Factories\AthleteRaceStrategyFactory;
use Mooncascade\Repositories\AbstractBaseRepository;
use Doctrine\ORM\EntityManager;

/**
 * Class AbstractObjectRetrievalStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractObjectRetrievalStrategy implements ObjectRetrievalStrategyInterface
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var RangeCalculationStrategy
     */
    protected $rangeCalculationStrategy;

    /**
     * @var AbstractBaseRepository
     */
    protected $repository;

    /**
     * @var AthleteRaceStrategyFactory
     */
    protected $timeRetrievalStrategyFactory;

    /**
     * AbstractObjectRetrievalStrategy constructor.
     * @param string $class
     * @param EntityManager $entityManager
     * @param RangeCalculationStrategy $rangeCalculationStrategy
     * @param AthleteRaceStrategyFactory $timeRetrievalStrategyFactory
     */
    public function __construct(
        $class,
        EntityManager $entityManager,
        RangeCalculationStrategy $rangeCalculationStrategy,
        AthleteRaceStrategyFactory $timeRetrievalStrategyFactory
    ) {
        $this->class = $class;
        $this->entityManager = $entityManager;
        $this->rangeCalculationStrategy = $rangeCalculationStrategy;
        $this->timeRetrievalStrategyFactory = $timeRetrievalStrategyFactory;

        /*
         * Get the repository based on
         * the provided class
         */
        $this->repository = $this->entityManager->getRepository($this->class);
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return AbstractObjectRetrievalStrategy
     */
    public function setClass(string $class): AbstractObjectRetrievalStrategy
    {
        $this->class = $class;

        return $this;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $entityManager
     * @return AbstractObjectRetrievalStrategy
     */
    public function setEntityManager(EntityManager $entityManager): AbstractObjectRetrievalStrategy
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    /**
     * @return RangeCalculationStrategy
     */
    public function getRangeCalculationStrategy(): RangeCalculationStrategy
    {
        return $this->rangeCalculationStrategy;
    }

    /**
     * @param RangeCalculationStrategy $rangeCalculationStrategy
     * @return AbstractObjectRetrievalStrategy
     */
    public function setRangeCalculationStrategy(RangeCalculationStrategy $rangeCalculationStrategy
    ): AbstractObjectRetrievalStrategy {
        $this->rangeCalculationStrategy = $rangeCalculationStrategy;

        return $this;
    }

    /**
     * @return AbstractBaseRepository
     */
    public function getRepository(): AbstractBaseRepository
    {
        return $this->repository;
    }

    /**
     * @param AbstractBaseRepository $repository
     * @return AbstractObjectRetrievalStrategy
     */
    public function setRepository(AbstractBaseRepository $repository): AbstractObjectRetrievalStrategy
    {
        $this->repository = $repository;

        return $this;
    }
}
