<?php

namespace Mooncascade\Strategies;

/**
 * Class RandomBooleanCalculationStrategy
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class RandomBooleanCalculationStrategy extends AbstractStrategy
{
    /**
     * @param array $params
     */
    public function configureParams(array $params)
    {
        $required = [
            'chance',
        ];

        // Set the required values
        $this->optionsResolver->setRequired($required);

        // Set the allowed type
        $this->optionsResolver->setAllowedTypes('chance', ['integer', 'double']);

        $this->optionsResolver->resolve($params);
    }

    /**
     * @param array $params
     * @return boolean
     */
    public function execute(array $params): bool
    {
        parent::execute($params);

        return $this->generator->boolean($params['chance']);
    }
}
