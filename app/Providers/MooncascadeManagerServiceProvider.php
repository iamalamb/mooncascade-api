<?php

namespace Mooncascade\Providers;

use Illuminate\Support\ServiceProvider;
use Mooncascade\Console\Commands\ExecuteRaceEventTask;
use Mooncascade\Managers\MooncascadeEventManagerInterface;

class MooncascadeManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * When app requires the MooncascadeEventManagerInterface
         * then provide our event manager as declared
         * in mooncascade.managers.event_manager
         *
         * Default: Mooncascade\Managers\MooncascadeEventManager
         */
        $this->app->singleton(
            MooncascadeEventManagerInterface::class,
            function () {
                $class = config('mooncascade.managers.event_manager');

                $delayRaceStart = config('mooncascade.race_delays.delay_race_start');
                $delayRaceStartTime = config('mooncascade.race_delays.delay_race_start_time');

                return new $class($delayRaceStart, $delayRaceStartTime);
            }
        );
    }
}
