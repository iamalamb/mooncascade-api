<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Mooncascade\Events\MooncascadePersistEntityEvent;
use Mooncascade\Events\MoonscadeBaseEventInterface;
use Mooncascade\Managers\MooncascadeFCMManager;
use Mooncascade\Managers\MooncascadeFCMManagerInterface;
use Mooncascade\Serializers\JSONSerializer;

class MooncascadePersistEntityEventListener extends AbstractFCMEventListener
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $key = 'athlete-event';

    /**
     * @var MooncascadeFCMManager
     */
    protected $mooncascadeFCMManager;

    /**
     * @var JSONSerializer
     */
    protected $serializer;

    /**
     * MooncascadePersistEntityEventListener constructor.
     * @param EntityManagerInterface $entityManager
     * @param MooncascadeFCMManager $mooncascadeFCMManager
     * @param JSONSerializer $serializer
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        MooncascadeFCMManager $mooncascadeFCMManager,
        JSONSerializer $serializer
    ) {
        $this->entityManager = $entityManager;
        $this->mooncascadeFCMManager = $mooncascadeFCMManager;
        $this->serializer = $serializer;
    }


    /**
     * Handle the event.
     *
     * @param  MoonscadeBaseEventInterface $event
     * @return void
     */
    public function handle(MoonscadeBaseEventInterface $event)
    {
        $entity = $event->getEntity();

        $message = 'Persisting athlete: '.$entity;

        if ($entity) {
            $this->entityManager->persist($entity);
        }

        $serializedEntity = $this->serializer->serialize($entity, ['groups' => ['event_overview']]);

        $payload = [
            'type'   => $this->key,
            'entity' => $serializedEntity,
        ];

        $this->mooncascadeFCMManager->execute($payload);
    }
}
