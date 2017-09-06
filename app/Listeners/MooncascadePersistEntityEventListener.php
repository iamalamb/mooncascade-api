<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Log;
use Mooncascade\Events\MooncascadePersistEntityEvent;
use Mooncascade\Managers\MooncascadeFCMManager;
use Mooncascade\Managers\MooncascadeFCMManagerInterface;
use Mooncascade\Serializers\JSONSerializer;

class MooncascadePersistEntityEventListener extends AbstractLoggableEventListener
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var MooncascadeFCMManagerInterface
     */
    protected $mooncascadeFCMManager;

    /**
     * @var JSONSerializer
     */
    protected $serializer;

    /**
     * AbstractLoggableEventListener constructor.
     * @param Log $logger
     * @param EntityManagerInterface $entityManager
     * @param JSONSerializer $serializer
     * @param MooncascadeFCMManager $mooncascadeFCMManager
     */
    public function __construct(
        Log $logger,
        EntityManagerInterface $entityManager,
        JSONSerializer $serializer,
        MooncascadeFCMManager $mooncascadeFCMManager
    ) {
        parent::__construct($logger);

        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->mooncascadeFCMManager = $mooncascadeFCMManager;
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

        $message = 'Persisting athlete: '.$entity;

        $this->logMessage($message);

        if ($entity) {
            $this->entityManager->persist($entity);
        }

        $serializedEntity = $this->serializer->serialize($entity, ['groups' => ['event_overview']]);

        $payload = [
            'type'   => 'athlete',
            'entity' => $serializedEntity,
        ];

        $this->mooncascadeFCMManager->execute($payload);
    }
}
