<?php

namespace Mooncascade\Providers;

use Faker\Factory;
use Illuminate\Support\ServiceProvider;
use Mooncascade\Entities\Athlete;
use Mooncascade\Managers\MooncascadeEventManager;
use Mooncascade\Managers\MooncascadeEventManagerInterface;
use Mooncascade\Strategies\ObjectRetrievalStrategy;
use Mooncascade\Strategies\RandomBooleanCalculationStrategy;
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

        $this->registerRangeCalculationStrategy();
        $this->registerRandomBooleanCalculationStrategy();
        $this->registerObjectRetrievalStrategy();

        /*
         * Register our MooncascadeEventManager service for use
         */
        $this->app->singleton(
            MooncascadeEventManagerInterface::class,
            function ($app) {

                // Get the config stuff
                $config = $app->make('config')->get('mooncascade');

                // Get the range calculation strategy

                $eventManager = new MooncascadeEventManager();

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

    /**
     * Internal function used to generate and
     * register the used RangeCalculationStrategy
     */
    private function registerRangeCalculationStrategy()
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
    }

    /**
     * Internal function used to generate and
     * register the used RandomBooleanCalculationStrategy
     */
    private function registerRandomBooleanCalculationStrategy()
    {
        /*
         * Register our Random boolean generator calculation strategy
         */
        $this->app->singleton(
            RandomBooleanCalculationStrategy::class,
            function ($app) {

                // Create a new Faker generator
                $generator = Factory::create();

                return new RandomBooleanCalculationStrategy($generator);

            }
        );
    }

    private function registerObjectRetrievalStrategy()
    {
        /*
         * Register the Object Retrieval Strategy
         */
        $this->app->singleton(ObjectRetrievalStrategy::class, function($app) {

            // Get the config stuff
            $config = $app->make('config')->get('mooncascade');

            // Get the EntityManager
            $entityManager = $app->make('em');

            // First get the strategy classname and entity class name
            $objectRetrievalClassName = $config['object_retrieval_strategy_class_name'];
            $class = $config['athlete_class_name'];

            $minThreshold = $config['batch_athlete_retrieval_min_threshold'];
            $maxThreshold = $config['batch_athlete_retrieval_max_threshold'];

            $rangeCalculationStrategy = $app->make(RangeCalculationStrategy::class);

            $objectRetrievalStrategy = new $objectRetrievalClassName($entityManager, $class, $rangeCalculationStrategy);

            $objectRetrievalStrategy
                ->setMinThreshold($minThreshold)
                ->setMaxThreshold($maxThreshold);
        });
    }
}
