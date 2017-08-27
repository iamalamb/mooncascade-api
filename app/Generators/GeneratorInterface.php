<?php

namespace Mooncascade\Generators;

/**
 * Interface GeneratorInterface
 *
 * Interface intended for injection
 * and to ensure that all concrete classes
 * correctly provide a means to generate a value
 */
interface GeneratorInterface
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
