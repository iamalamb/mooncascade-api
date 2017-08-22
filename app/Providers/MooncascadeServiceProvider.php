<?php

namespace Mooncascade\Providers;

use Faker\Factory;
use Illuminate\Support\ServiceProvider;
use Mooncascade\Entities\Athlete;
use Mooncascade\Managers\MooncascadeEventManager;
use Mooncascade\Managers\MooncascadeEventManagerInterface;
use Mooncascade\Strategies\RangeCalculationStrategy;

class MooncascadeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Register our Range calculation strategy
         */
        $this->app->singleton(
            RangeCalculationStrategy::class,
            function ($app) {

                // Create a new Faker generator
                $generator = Factory::create();

                return new RangeCalculationStrategy($generator);

            }
        );

        /*
         * Register our MooncascadeEventManager service for use
         */
        $this->app->singleton(
            MooncascadeEventManagerInterface::class,
            function ($app) {

                // Get the config stuff
                $config = $app->make('config')->get('mooncascade');

                // Get the range calculation strategy
                $rangeCalculationStrategy = $app->make(RangeCalculationStrategy::class);

                // Get the EntityManager
                $entityManager = $app->make('em');
                $repository = $entityManager->getRepository(Athlete::class);

                $eventManager = new MooncascadeEventManager($rangeCalculationStrategy, $repository);

                $eventManager
                    ->setDelayRaceStart($config['delay_race_start'])
                    ->setDelayRaceStartTime($config['delay_race_start_time']);

                return $eventManager;

            }
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
