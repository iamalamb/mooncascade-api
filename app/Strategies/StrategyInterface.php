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
     * Core function intended to be implemented by
     * all concrete classes intending to implement
     * this interface.
     *
     * @return mixed
     */
    public function execute();
}
