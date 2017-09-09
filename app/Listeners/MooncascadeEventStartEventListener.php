<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MoonscadeBaseEventInterface;
use Mooncascade\Managers\MooncascadeFCMManager;
use Mooncascade\Strategies\StrategyInterface;

class MooncascadeEventStartEventListener extends AbstractFCMEventListener
{
    protected $key = 'event-start';

    /**
     * @var StrategyInterface
     */
    protected $strategy;

    /**
     * AbstractFCMEventListener constructor.
     * @param MooncascadeFCMManager $mooncascadeFCMManager
     * @param StrategyInterface $strategy
     */
    public function __construct(MooncascadeFCMManager $mooncascadeFCMManager, StrategyInterface $strategy)
    {
        parent::__construct($mooncascadeFCMManager);

        $this->strategy = $strategy;
    }

    /**
     * @param MoonscadeBaseEventInterface $event
     */
    public function handle(MoonscadeBaseEventInterface $event)
    {
        parent::handle($event);

        $this->strategy->execute();
    }
}
