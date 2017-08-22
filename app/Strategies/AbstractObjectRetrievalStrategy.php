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
     * @param array $params
     * @return mixed
     */
    public function execute(array $params)
    {
        $this->configureParams($params);
    }
}
