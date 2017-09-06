<?php

namespace Mooncascade\Events;

use Illuminate\Foundation\Events\Dispatchable;

class MooncascadeAllAthleteThroughGateEvent implements MoonscadeBaseEventInterface
{
    use Dispatchable;

    /**
     *
     */
    public function getPayload()
    {
        return microtime(true);
    }
}
