<?php

namespace Mooncascade\Factories;


/**
 * Class TimeRetrievalStrategyFactory
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class TimeRetrievalStrategyFactory implements FactoryInterface
{
    protected $strategies = [];

    /**
     * TimeRetrievalStrategyFactory constructor.
     * @param array $strategies
     */
    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    /**
     * @inheritDoc
     */
    public function create($key): FactoryItemInterface
    {
        if (array_has($this->strategies, $key)) {
            return $this->strategies[$key];
        } else {
            throw new \InvalidArgumentException();
        }
    }


}
