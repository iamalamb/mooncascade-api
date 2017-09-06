<?php

namespace Mooncascade\Events;

use Illuminate\Foundation\Events\Dispatchable;

class MooncascadeEventCompletedEvent implements MoonscadeBaseEventInterface
{
    use Dispatchable;

    public function getPayload()
    {
        return microtime(true);
    }
}
