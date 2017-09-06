<?php

namespace Mooncascade\Listeners;

use Illuminate\Support\Facades\Log;
use Mooncascade\Events\MoonscadeBaseEventInterface;
use Mooncascade\Managers\MooncascadeFCMManager;
use Mooncascade\Managers\MooncascadeFCMManagerInterface;

/**
 * Class AbstractFCMEventListener
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractFCMEventListener
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
     * @param MooncascadeFCMManager $mooncascadeFCMManager
     */
    public function __construct(MooncascadeFCMManager $mooncascadeFCMManager)
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
