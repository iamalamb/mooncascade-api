<?php

namespace Mooncascade\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Mooncascade\Entities\Athlete;

class MooncascadePersistEntityEvent implements MoonscadeBaseEventInterface
{
    use Dispatchable;

    /**
     * @var Athlete
     */
    protected $entity;

    /**
     * @return Athlete
     */
    public function getEntity(): Athlete
    {
        return $this->entity;
    }

    /**
     * @param Athlete $entity
     * @return MooncascadePersistEntityEvent
     */
    public function setEntity(Athlete $entity): MooncascadePersistEntityEvent
    {
        $this->entity = $entity;

        return $this;
    }

    public function getPayload()
    {
        return $this->getEntity();
    }
}
