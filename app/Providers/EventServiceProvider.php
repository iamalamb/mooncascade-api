<?php

namespace Mooncascade\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Mooncascade\Events\MooncascadeDelayedStartEvent'   => [
            'Mooncascade\Listeners\MooncascadeDelayedStartEventListener',
        ],
        'Mooncascade\Events\MooncascadeEventStartEvent'     => [
            'Mooncascade\Listeners\MooncascadeEventStartEventListener',
        ],
        'Mooncascade\Events\MooncascadePersistEntityEvent' => [
            'Mooncascade\Listeners\MooncascadePersistEntityEventListener',
        ],
        'Mooncascade\Events\MooncascadeAthleteGateEvent' => [
            'Mooncascade\Listeners\MooncascadeAthleteGateEventListener',
        ],
        'Mooncascade\Events\MooncascadeAthleteFinishEvent' => [
            'Mooncascade\Listeners\MooncascadeAthleteFinishEventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
