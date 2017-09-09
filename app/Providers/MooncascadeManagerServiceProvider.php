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
         * When our execute race event task requires
         * and MooncascadeEventManagerInterface
         * the provide our event manager as declared
         * in mooncascade.managers.event_manager
         *
         * Default: Mooncascade\Managers\MooncascadeEventManager
         */
        $this->app
            ->when(ExecuteRaceEventTask::class)
            ->needs(MooncascadeEventManagerInterface::class)
            ->give(config('mooncascade.managers.event_manager'));

        /*
         * When the MooncascadeEventManagerInterface::class
         * requires it's parameters, get them from configuration
         */
        $this
            ->app
            ->when(MooncascadeEventManagerInterface::class)
            ->needs('$delayRaceStart')
            ->give(config('mooncascade.race_delays.delay_race_start'));

        $this
            ->app
            ->when(MooncascadeEventManagerInterface::class)
            ->needs('$delayRaceStartTime')
            ->give(config('mooncascade.race_delays.delay_race_start_time'));
    }
}
