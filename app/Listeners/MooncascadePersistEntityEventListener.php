<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Log;
use Mooncascade\Events\MooncascadeBroadcastAthleteEvent;
use Mooncascade\Events\MooncascadePersistEntityEvent;
use Mooncascade\Serializers\JSONSerializer;

class MooncascadePersistEntityEventListener extends AbstractLoggableEventListener
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var JSONSerializer
     */
    protected $serializer;

    /**
     * AbstractLoggableEventListener constructor.
     * @param Log $logger
     */
    public function __construct(Log $logger, EntityManagerInterface $entityManager, JSONSerializer $serializer)
    {
        parent::__construct($logger);

        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
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

        $broadCastEvent = new MooncascadeBroadcastAthleteEvent();
        $broadCastEvent->setEntity($this->serializer->serialize($entity, ['groups' => ['overview']]));

        broadcast($broadCastEvent);
    }
}
