<?php

namespace Mooncascade\Listeners;

use Doctrine\ORM\EntityRepository;
use Illuminate\Support\Facades\Log;
use Mooncascade\Events\MooncascadeEventStartEvent;
use Mooncascade\Events\MoonscadeBaseEventInterface;
use Mooncascade\Strategies\AthleteRetrievalStrategy;

class MooncascadeEventStartEventListener extends AbstractFCMEventListener
{
    protected $key = 'event-start';
}
