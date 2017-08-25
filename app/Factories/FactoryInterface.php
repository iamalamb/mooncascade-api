<?php

namespace Mooncascade\Factories;

/**
 * Class FactoryInterface
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface FactoryInterface
{

    /**
     * Intended for concrete classes
     * to implement in order to retrieve
     * a particular service
     *
     * @param $key
     * @return mixed
     */
    public function create($key): FactoryItemInterface;
}
