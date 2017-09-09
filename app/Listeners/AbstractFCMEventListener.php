<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MoonscadeBaseEventInterface;
use Mooncascade\Managers\MooncascadeFCMManager;
use Mooncascade\Managers\MooncascadeFCMManagerInterface;

/**
 * Class AbstractFCMEventListener
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractFCMEventListener implements FCMEventListenerInterface
{
    /**
     * @var string
     */
    protected $key = '';

    /**
     * @var MooncascadeFCMManagerInterface
     */
    protected $mooncascadeFCMManager;

    /**
     * AbstractFCMEventListener constructor.
     * @param MooncascadeFCMManagerInterface $mooncascadeFCMManager
     */
    public function __construct(MooncascadeFCMManagerInterface $mooncascadeFCMManager)
    {
        $this->mooncascadeFCMManager = $mooncascadeFCMManager;
    }

    /**
     * @param MoonscadeBaseEventInterface $event
     */
    public function handle(MoonscadeBaseEventInterface $event)
    {
        $payload = $this->configurePayload($event);

        $this->mooncascadeFCMManager->execute($payload);
    }

    /**
     * @param MoonscadeBaseEventInterface $event
     * @return array
     */
    public function configurePayload(MoonscadeBaseEventInterface $event)
    {
        return [
            'event'   => $this->key,
            'payload' => [$event->getPayload()],
        ];
    }
}
