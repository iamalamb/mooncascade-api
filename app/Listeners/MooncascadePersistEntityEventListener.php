<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MooncascadePersistEntityEvent;

class MooncascadePersistEntityEventListener
{
    /**
     * @var EntityManagerInterfac
     */
    protected $entityManager;

    /**
     * Handle the event.
     *
     * @param  MooncascadePersistEntityEvent $event
     * @return void
     */
    public function handle(MooncascadePersistEntityEvent $event)
    {
        $entity = $event->getEntity();

        if ($entity) {
            $this->entityManager->persist($entity);
        }

    }
}
