<?php

namespace Mooncascade\Contracts\Strategies;

/**
 * Class AthleteRetrievalStrategy
 *
 * Based on the Strategy pattern, and intended
 * to provide a single interface for all concerete
 * instances to implement.
 *
 * @see https://laravel.com/docs/5.4/contracts
 * https://sourcemaking.com/design_patterns/strategy
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface Strategy
{
    /**
     * Intended method for all concerete stratgies
     * to implement.
     */
    public function execute();
}