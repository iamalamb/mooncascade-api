<?php

namespace Mooncascade\Providers;

use Faker\Factory;
use Illuminate\Support\ServiceProvider;
use Mooncascade\Entities\Athlete;
use Mooncascade\Managers\MooncascadeEventManager;
use Mooncascade\Managers\MooncascadeEventManagerInterface;
use Mooncascade\Strategies\ObjectRetrievalStrategyInterface;
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

}
