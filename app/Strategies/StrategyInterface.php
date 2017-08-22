<?php

namespace Mooncascade\Strategies;

/**
 * Interface StrategyInterface
 *
 * Interface used to ensure correct implementation of the Strategy Design Pattern
 * @see https://sourcemaking.com/design_patterns/strategy
 */
interface StrategyInterface
{
    /**
     * Core internal function intended by all concrete
     * implmentations to check/configure the $params
     * argument passed to the execute function.
     *
     * @param $params
     */
    public function configureParams(array $params);

    /**
     * Core function intended to be implemented by
     * all concrete classes intending to implement
     * this interface.
     *
     * @param array $params
     * @return mixed
     */
    public function execute(array $params);
}
