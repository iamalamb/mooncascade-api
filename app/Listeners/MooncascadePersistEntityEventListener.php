<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Log;
use Mooncascade\Events\MooncascadePersistEntityEvent;

class MooncascadePersistEntityEventListener extends AbstractLoggableEventListener
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * AbstractLoggableEventListener constructor.
     * @param Log $logger
     */
    public function __construct(Log $logger, EntityManagerInterface $entityManager)
    {
        parent::__construct($logger);

        $this->entityManager = $entityManager;
    }

    /**
     * Handle the event.
     *
     * @param  MooncascadePersistEntityEvent $event
     * @return void
     */
    public function handle(MooncascadePersistEntityEvent $event)
    {
        $entity = $event->getEntity();

        $message = 'Persisting athlete: ' . $entity;

        $this->logMessage($message);

        if ($entity) {
            $this->entityManager->persist($entity);
        }

    }
}
