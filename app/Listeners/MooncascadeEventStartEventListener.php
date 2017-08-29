<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Log;
use Mooncascade\Events\MooncascadeEventStartEvent;

class MooncascadeEventStartEventListener extends AbstractLoggableEventListener
{
    /**
     * @var EntityRepository
     */
    protected $repository;

    /**
     * @inheritDoc
     */
    public function __construct(Log $logger, EntityRepository $repository)
    {
        parent::__construct($logger);

        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  MooncascadeEventStartEvent  $event
     * @return void
     */
    public function handle(MooncascadeEventStartEvent $event)
    {
        $message = 'Event has now started';
        $this->logMessage($message);
    }
}
