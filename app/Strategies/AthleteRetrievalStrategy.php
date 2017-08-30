<?php

namespace Mooncascade\Strategies;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Mooncascade\Events\MooncascadeBatchRetrievalEvent;
use Mooncascade\Generators\RandomIntegerGenerator;

/**
 * Class AthleteRetrievalStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class AthleteRetrievalStrategy implements StrategyInterface
{
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
        $this->randomIntegerGenerator
            ->setMin($this->min)
            ->setMax($this->max);

        $limit = $this->randomIntegerGenerator->generate();

        $criteria = [
            'timeAtGate' => null,
        ];

        $execute = true;

        while ($execute) {

            $entities = collect($this->repository->findBy($criteria, null, $limit));

            if ($entities->count()) {

                $entities->each(
                    function ($entity) {

                        $entity->setTimeAtGate(time());
                        $this->entityManager->persist($entity);

                    }
                );

                $event = new MooncascadeBatchRetrievalEvent();
                $event->setEntities($entities);
                event($event);

                $this->entityManager->flush();

            } else {

                $execute = false;
            }

        }
    }
}
