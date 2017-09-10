<?php

namespace Mooncascade\Providers;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\ServiceProvider;
use LaravelFCM\Message\PayloadDataBuilder;
use Mooncascade\Contracts\Managers\MooncascadeEventManager;
use Mooncascade\Contracts\Managers\MooncascadeFCMManager;

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
         * When the app requires the MooncascadeEventManager contract
         * then provide our event manager as declared
         * in mooncascade.managers.event_manager
         *
         * Default: Mooncascade\Managers\MooncascadeEventManager
         */
        $this->app->singleton(
            MooncascadeEventManager::class,
            function () {
                $class = config('mooncascade.managers.event_manager');

                $delayRaceStart = config('mooncascade.race_delays.delay_race_start');
                $delayRaceStartTime = config('mooncascade.race_delays.delay_race_start_time');

                return new $class($delayRaceStart, $delayRaceStartTime);
            }
        );

        /*
         * When the app requires the MooncascadeFCMManagerContract
         * then provide our FCM manager as declared in mooncascade.managers.event_manager
         *
         * Default: Mooncascade\Managers\MooncascadeFCMManager
         */
        $this->app->singleton(
            MooncascadeFCMManager::class,
            function ($app) {

                $class = config('mooncascade.managers.fcm_manager');

                $cache = $app->make(Repository::class);
                $fcmSender = $app->make('fcm.sender');
                $payloadDataBuilder = new PayloadDataBuilder();

                return new $class($cache, $fcmSender, $payloadDataBuilder);

            }
        );
    }
}
