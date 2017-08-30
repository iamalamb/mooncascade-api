<?php

namespace Mooncascade\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Collection;

class MooncascadeBatchRetrievalEvent
{
    use Dispatchable;

    /**
     * @var Collection
     */
    protected $entities;

    /**
     * MooncascadeBatchRetrievalEvent constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Collection
     */
    public function getEntities(): Collection
    {
        return $this->entities;
    }

    /**
     * @param Collection $entities
     * @return MooncascadeBatchRetrievalEvent
     */
    public function setEntities(Collection $entities): MooncascadeBatchRetrievalEvent
    {
        $this->entities = $entities;

        return $this;
    }
}
