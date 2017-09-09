<?php

namespace Mooncascade\Listeners;

use Mooncascade\Events\MoonscadeBaseEventInterface;


/**
 * Class AbstractFCMEventListener
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
interface FCMEventListenerInterface
{
    /**
     * @param MoonscadeBaseEventInterface $event
     */
    public function handle(MoonscadeBaseEventInterface $event);

    /**
     * @param MoonscadeBaseEventInterface $event
     * @return array
     */
    public function configurePayload(MoonscadeBaseEventInterface $event);
}