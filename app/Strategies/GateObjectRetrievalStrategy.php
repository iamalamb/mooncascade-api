<?php

namespace Mooncascade\Strategies;

/**
 * Class GateObjectRetrievalStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class GateObjectRetrievalStrategy extends AbstractObjectRetrievalStrategy
{
    /**
     * @param array $params
     */
    public function execute(array $params)
    {

        // First calculate the batch range
        $props = [
            'min' => $params['batch_athlete_retrieval_min_threshold'],
            'max' => $params['batch_athlete_retrieval_max_threshold'],
        ];

        $total = $this->rangeCalculationStrategy->execute($props);
        $offset = 0;

        $criteria = [];

        $entities = collect($this->repository->findBy($criteria, null, $total, $offset));

        // Loop through entity
        $entities->each(
            function ($entity) use ($params) {

                // Generate a random time to sleep by
                $props = [
                    'min' => $params['batch_athlete_retrieval_min_threshold'],
                    'max' => $params['batch_athlete_retrieval_max_threshold'],
                ];

                // Put the script to sleep
                $time = $this->rangeCalculationStrategy->execute($props);
                sleep($time);

                // Set the time at gate and persist the entity
                $entity->setTimeAtGate(microtime(true));
                $this->entityManager->persist($entity);
            }
        );

        $this->entityManager->flush();

        return $entities;
    }
}
