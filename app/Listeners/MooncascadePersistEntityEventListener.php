<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Mooncascade\Events\MooncascadePersistEntityEvent;

class MooncascadePersistEntityEventListener
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * MooncascadePersistEntityEventListener constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
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

        if ($entity) {
            $this->entityManager->persist($entity);
        }

    }
}
