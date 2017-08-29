<?php

namespace Mooncascade\Listeners;
use Illuminate\Support\Facades\Log;

/**
 * Class AbstractLoggableEventListener
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractLoggableEventListener
{
    /**
     * @var Log
     */
    protected $logger;

    /**
     * AbstractLoggableEventListener constructor.
     * @param Log $logger
     */
    public function __construct(Log $logger)
    {
        $this->logger = $logger;
    }

    protected function logMessage($message)
    {
        $this->logger::info($message);
    }
}
