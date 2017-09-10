<?php

namespace Mooncascade\Factories\Generators;

/**
 * Interface Generator
 *
 * Interface intended for injection
 * and to ensure that all concrete classes
 * correctly provide a means to generate a value
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface Generator
{
    /**
     * Intended to provide a standard means
     * for all concerete classes to provide
     * a generated value
     *
     * @return mixed
     */
    public function generate();
}
