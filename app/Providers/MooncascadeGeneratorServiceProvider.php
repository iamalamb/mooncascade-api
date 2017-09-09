<?php

namespace Mooncascade\Providers;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;
use Mooncascade\Generators\GeneratorInterface;

class MooncascadeGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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
        $this->app
            ->when(GeneratorInterface::class)
            ->needs(Generator::class)
            ->give(Factory::create());

        // Register a boolean generator
        /*$this->app
            ->singleton(
                RandomBooleanGenerator::class,
                function ($app) use ($generator) {

                    $booleanGenerator = new RandomBooleanGenerator();
                    $booleanGenerator->setGenerator($generator);

                    return $booleanGenerator;
                }
            );

        // Register the random integer generator
        $this->app
            ->singleton(
                RandomIntegerGenerator::class,
                function ($app) use ($generator) {

                    $integerGenerator = new RandomIntegerGenerator();
                    $integerGenerator->setGenerator($generator);

                    return $integerGenerator;
                }
            );

        // Register the race strategy event generator
        $this->app->singleton(
            RandomRaceStrategyEventGenerator::class,
            function ($app) {

                $factory = $app->make(AthleteRaceStrategyFactory::class);

                $eventGenerator = new RandomRaceStrategyEventGenerator();

                $eventGenerator->setStrategyFactory($factory);

                return $eventGenerator;
            }
        );*/
    }
}
