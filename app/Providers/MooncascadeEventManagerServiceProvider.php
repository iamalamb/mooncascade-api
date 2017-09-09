<?php

namespace Mooncascade\Providers;

use Mooncascade\Console\Commands\ExecuteRaceEventTask;
use Mooncascade\Managers\MooncascadeEventManager;
use Mooncascade\Managers\MooncascadeEventManagerInterface;

class MooncascadeEventManagerServiceProvider extends MooncascadeServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            MooncascadeEventManagerInterface::class,
            function () {

                $delayRaceStart = $this->options['delay_race_start'];
                $delayRaceStartTime = $this->options['delay_race_start_time'];

                $eventManager = new MooncascadeEventManager($delayRaceStart, $delayRaceStartTime);

                return $eventManager;
            }
        );

//        $this->app->singleton(MooncascadeFCMManagerInterface::class);
    }
}
