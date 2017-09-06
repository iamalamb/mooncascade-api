<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Log;
use FCM;
use LaravelFCM\Message\PayloadDataBuilder;
use Mooncascade\Events\MooncascadePersistEntityEvent;
use Mooncascade\Serializers\JSONSerializer;

class MooncascadePersistEntityEventListener extends AbstractLoggableEventListener
{
    /**
     * @var Repository
     */
    protected $cache;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var PayloadDataBuilder
     */
    protected $payloadDataBuilder;

    /**
     * @var JSONSerializer
     */
    protected $serializer;

    /**
     * AbstractLoggableEventListener constructor.
     * @param Log $logger
     */
    public function __construct(
        Log $logger,
        EntityManagerInterface $entityManager,
        JSONSerializer $serializer,
        PayloadDataBuilder $payloadDataBuilder,
        Repository $cache
    ) {
        parent::__construct($logger);

        $this->cache = $cache;
        $this->entityManager = $entityManager;
        $this->payloadDataBuilder = $payloadDataBuilder;
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

        $message = 'Persisting athlete: '.$entity;

        $this->logMessage($message);

        if ($entity) {
            $this->entityManager->persist($entity);
        }

        // Check first if we have registered keys to broadcast to
        if($this->cache->has('tokens')) {

            $serializedEntity = $this->serializer->serialize($entity, ['groups' => ['event_overview']]);
            $this->payloadDataBuilder->addData(['entity' => $serializedEntity]);
            $data = $this->payloadDataBuilder->build();

            $tokens = $this->cache->get('tokens');
            FCM::sendTo($tokens, null, null, $data);
        }
    }
}
