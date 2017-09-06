<?php

namespace Mooncascade\Listeners;

class MooncascadeDelayedStartEventListener extends AbstractFCMEventListener
{
    /**
     * @var string
     */
    protected $key = 'event-delay';
}
