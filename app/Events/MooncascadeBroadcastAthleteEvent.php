<?php

namespace Mooncascade\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MooncascadeBroadcastAthleteEvent implements ShouldBroadcast
{
    /**
     * @var string
     */
    protected $entity;

    /**
     * @return string
     */
    public function getEntity(): string
    {
        return $this->entity;
    }

    /**
     * @param string $entity
     * @return MooncascadeBroadcastAthleteEvent
     */
    public function setEntity(string $entity): MooncascadeBroadcastAthleteEvent
    {
        $this->entity = $entity;

        return $this;
    }


    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'mooncascade.api.athlete.updated';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('mooncascade-api');
    }

    /**
     * @return string
     */
    public function broadcastWith()
    {
        return $this->entity;
    }
}
