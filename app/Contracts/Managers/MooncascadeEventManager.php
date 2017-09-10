<?php

namespace Mooncascade\Contracts\Managers;

/**
 * Interface MooncascadeEventManager
 *
 * Primary Laravel "Contract" intended for
 * implementation by any concrete implementations
 * of the MooncascadeEventManager.
 *
 * @see https://laravel.com/docs/5.4/contracts
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface MooncascadeEventManager
{
    /**
     * Execute function intended to start the
     * initial event. This SHOULD be intended
     * as the initial entry point for all
     * underlying processes.
     */
    public function execute();
}
