<?php

namespace Mooncascade\Strategies;

/**
 * Class TieAthleteStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class TieAthleteStrategy extends AbstractTimeCalculationStrategy
{
    /**
     * @param array $params
     * @return mixed
     */
    public function configureParams(array $params)
    {
        $required = [
            'entities',
        ];

        $this->optionsResolver->setRequired($required);

        $this->optionsResolver->setAllowedTypes('entities', 'array');
    }

    /**
     * @param array $entities
     * @return mixed
     */
    public function handleMultipleEntities(array $entities)
    {
        // TODO: Implement handleMultipleEntities() method.
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function execute(array $params)
    {
        parent::execute($params);

        /*
         * Check that we have more than one
         * entity to work with. If there
         * is only one, it's pointless
         * and we can simply return the entity
         * back.
         */
        $entities = $params['entities'];

        if ($entities->count() <= 1) {

            // Get the the entity

            return $entities;
        }

        /*
         * We have more than one entity
         * so decide randomly if we should tie them
         * or not.
         */
        $shouldTie = $this->booleanCalculationStrategy->execute(['chance' => 50]);

        if ($shouldTie) {


        }
    }

}
