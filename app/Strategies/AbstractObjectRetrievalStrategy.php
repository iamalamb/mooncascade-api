<?php

namespace Mooncascade\Strategies;

use Mooncascade\Repositories\AbstractBaseRepository;
use Doctrine\Common\Persistence\ObjectRepository;

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
     * @var AbstractBaseRepository
     */
    protected $repository;

    /**
     * AbstractObjectRetrievalStrategy constructor.
     * @param AbstractBaseRepository $repository
     */
    public function __construct(AbstractBaseRepository $repository)
    {
        $this->repository = $repository;
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
