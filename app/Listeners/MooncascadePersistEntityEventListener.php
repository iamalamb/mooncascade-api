<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Mooncascade\Entities\Athlete;
use Mooncascade\Events\MooncascadeEventCompletedEvent;
use Mooncascade\Events\MoonscadeBaseEventInterface;
use Mooncascade\Managers\MooncascadeFCMManager;
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
        $payload = $this->configurePayload($event);

        $this->mooncascadeFCMManager->execute($payload);

        $this->checkIfEventComplete();
    }

    /**
     * @param MoonscadeBaseEventInterface $event
     * @return array
     */
    public function configurePayload(MoonscadeBaseEventInterface $event)
    {
        $entity = $event->getEntity();

        if ($entity) {

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
        }

        $serializedEntity = $this->serializer->serialize($entity, ['groups' => ['event_overview']]);

        $payload = [
            'event'   => $this->key,
            'entity' => $serializedEntity,
        ];

        return $payload;
    }

    public function checkIfEventComplete()
    {
        $criteria = [
            'timeAtFinish' => null,
        ];

        $repository = $this->entityManager->getRepository(Athlete::class);

        $this->entityManager->flush();
        $entities = collect($repository->findBy($criteria));

        if (!$entities->count()) {
            $event = new MooncascadeEventCompletedEvent();
            event($event);
        }
    }
}
