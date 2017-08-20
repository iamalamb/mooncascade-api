<?php

namespace Mooncascade\Managers;

/**
 * Interface MooncascadeEventManager
 *
 * Responsible for the execution of the demo event
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface MooncascadeEventManagerInterface
{
    /**
     * Single point of execution.
     * Responsible for all underlying processes.
     */
    public function execute();
}