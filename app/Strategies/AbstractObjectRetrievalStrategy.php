<?php

namespace Mooncascade\Strategies;

use Mooncascade\Repositories\AbstractBaseRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * Class AbstractObjectRetrievalStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractObjectRetrievalStrategy implements StrategyInterface
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
     * @var AbstractBaseRepository
     */
    protected $repository;

    /**
     * AbstractObjectRetrievalStrategy constructor.
     * @param string $class
     * @param EntityManager $entityManager
     */
    public function __construct($class, EntityManager $entityManager)
    {
        $this->class = $class;
        $this->entityManager = $entityManager;

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
