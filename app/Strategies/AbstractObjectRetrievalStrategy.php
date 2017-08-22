<?php

namespace Mooncascade\Strategies;

use Mooncascade\Repositories\AbstractBaseRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Strategies\RangeCalculationStrategy;

/**
 * Class AbstractObjectRetrievalStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractObjectRetrievalStrategy implements StrategyInterface, ObjectRetrievalStrategy
{
    /**
     * @var array
     */
    protected $criteria = [];

    /**
     * @var string
     */
    protected $class;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var integer
     */
    protected $minThreshold;

    /**
     * @var integer
     */
    protected $maxThreshold;

    /**
     * @var RangeCalculationStrategy
     */
    protected $rangeCalculationStrategy;

    /**
     * @var AbstractBaseRepository
     */
    protected $repository;

    /**
     * AbstractObjectRetrievalStrategy constructor.
     * @param string $class
     * @param EntityManager $entityManager
     * @param  RangeCalculationStrategy $rangeCalculationStrategy
     */
    public function __construct($class, EntityManager $entityManager, RangeCalculationStrategy $rangeCalculationStrategy)
    {
        $this->class = $class;
        $this->entityManager = $entityManager;
        $this->rangeCalculationStrategy = $rangeCalculationStrategy;

        /*
         * Get the repository based on
         * the provided class
         */
        $this->repository = $this->entityManager->getRepository($this->class);
    }

    /**
     * @return array
     */
    public function getCriteria(): array
    {
        return $this->criteria;
    }

    /**
     * @param array $criteria
     * @return AbstractObjectRetrievalStrategy
     */
    public function setCriteria(array $criteria): AbstractObjectRetrievalStrategy
    {
        $this->criteria = $criteria;

        return $this;
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
     * @return int
     */
    public function getMinThreshold(): int
    {
        return $this->minThreshold;
    }

    /**
     * @param int $minThreshold
     * @return AbstractObjectRetrievalStrategy
     */
    public function setMinThreshold(int $minThreshold): AbstractObjectRetrievalStrategy
    {
        $this->minThreshold = $minThreshold;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxThreshold(): int
    {
        return $this->maxThreshold;
    }

    /**
     * @param int $maxThreshold
     * @return AbstractObjectRetrievalStrategy
     */
    public function setMaxThreshold(int $maxThreshold): AbstractObjectRetrievalStrategy
    {
        $this->maxThreshold = $maxThreshold;

        return $this;
    }

    /**
     * @return \Mooncascade\Strategies\RangeCalculationStrategy
     */
    public function getRangeCalculationStrategy(): \Mooncascade\Strategies\RangeCalculationStrategy
    {
        return $this->rangeCalculationStrategy;
    }

    /**
     * @param \Mooncascade\Strategies\RangeCalculationStrategy $rangeCalculationStrategy
     * @return AbstractObjectRetrievalStrategy
     */
    public function setRangeCalculationStrategy(
        \Mooncascade\Strategies\RangeCalculationStrategy $rangeCalculationStrategy
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
