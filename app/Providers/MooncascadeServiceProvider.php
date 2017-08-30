<?php

namespace Mooncascade\Providers;

use Faker\Factory;
use Illuminate\Support\ServiceProvider;
use Mooncascade\Entities\Athlete;
use Mooncascade\Factories\AthleteRaceStrategyFactory;
use Mooncascade\Generators\RandomBooleanGenerator;
use Mooncascade\Generators\RandomIntegerGenerator;
use Mooncascade\Generators\RandomRaceStrategyEventGenerator;
use Mooncascade\Handlers\ObjectRetrievalHandler;
use Mooncascade\Handlers\ObjectRetrievalHandlerInterface;
use Mooncascade\Managers\MooncascadeEventManager;
use Mooncascade\Managers\MooncascadeEventManagerInterface;
use Mooncascade\Strategies\AthleteRaceStrategyInterface;
use Mooncascade\Strategies\AthleteRetrievalStrategy;
use Mooncascade\Strategies\ObjectRetrievalStrategyInterface;
use Mooncascade\Strategies\OvertakeAthleteRaceStrategy;
use Mooncascade\Strategies\RandomBooleanCalculationStrategy;
use Mooncascade\Strategies\RangeCalculationStrategy;
use Mooncascade\Strategies\SequentialAthleteRaceStrategy;
use Mooncascade\Strategies\TieAthleteRaceStrategy;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class MooncascadeServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    protected function resolveOptions()
    {
        // First ensure the configuration is correct
        $this->optionsResolver = new OptionsResolver();

        $this->options = config('mooncascade');

        $required = [
            'total_teams',
            'total_athletes',
            'max_athlete_age',
            'min_athlete_age',
            'delay_race_start',
            'delay_race_start_time',
            'delay_athlete_execution_min_threshold',
            'delay_athlete_execution_max_threshold',
            'batch_athlete_retrieval_max_threshold',
            'batch_athlete_retrieval_min_threshold',
            'available_strategies',
            'gate_strategies',
        ];

        $this->optionsResolver->setRequired($required);

        $this->optionsResolver->resolve($this->options);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->resolveOptions();

        $this->registerGenerators();
        $this->registerStrategies();
        $this->registerEventManager();
        $this->registerFactories();
    }

    private function registerGenerators()
    {
        $generator = Factory::create();

        // Register a boolean generator
        $this->app
            ->singleton(
                RandomBooleanGenerator::class,
                function ($app) use ($generator) {

                    $booleanGenerator = new RandomBooleanGenerator();
                    $booleanGenerator->setGenerator($generator);

                    return $booleanGenerator;
                }
            );

        /**
         * Need a bit more effort to ensure that the
         * random integer is correctly registered based
         * on it's usage
         */
        // Get the configuration
        $this->app
            ->singleton(
                RandomIntegerGenerator::class,
                function ($app) use ($generator) {

                    $integerGenerator = new RandomIntegerGenerator();
                    $integerGenerator->setGenerator($generator);

                    return $integerGenerator;
                }
            );

        $this->app->singleton(
            RandomRaceStrategyEventGenerator::class,
            function ($app) {

                $factory = $app->make(AthleteRaceStrategyFactory::class);

                $eventGenerator = new RandomRaceStrategyEventGenerator();

                $eventGenerator->setStrategyFactory($factory);

                return $eventGenerator;
            }
        );
    }

    protected function registerEventManager()
    {
        $this->app->bind(
            MooncascadeEventManagerInterface::class,
            function ($app) {

                $delayRaceStart = $this->options['delay_race_start'];
                $delayRaceStartTime = $this->options['delay_race_start_time'];

                $eventManager = new MooncascadeEventManager();

                $eventManager
                    ->setDelayRaceStart($delayRaceStart)
                    ->setDelayRaceStartTime($delayRaceStartTime);

                return $eventManager;
            }
        );
    }

    protected function registerStrategies()
    {
        $generator = $this->app->make(RandomIntegerGenerator::class);
        $propertyAccessor = new PropertyAccessor();

        $min = $this->options['delay_athlete_execution_min_threshold'];
        $max = $this->options['delay_athlete_execution_min_threshold'];

        $this->app->singleton(
            OvertakeAthleteRaceStrategy::class,
            function ($app) use ($generator, $propertyAccessor, $min, $max) {

                $overtakeStrategy = new OvertakeAthleteRaceStrategy();

                $overtakeStrategy
                    ->setIntegerGenerator($generator)
                    ->setMin($min)
                    ->setMax($max)
                    ->setPropertyAccessor($propertyAccessor);

                return $overtakeStrategy;
            }
        );

        $this->app->singleton(
            SequentialAthleteRaceStrategy::class,
            function ($app) use ($generator, $propertyAccessor, $min, $max) {

                $sequentialStrategy = new SequentialAthleteRaceStrategy();

                $sequentialStrategy
                    ->setIntegerGenerator($generator)
                    ->setMin($min)
                    ->setMax($max)
                    ->setPropertyAccessor($propertyAccessor);

                return $sequentialStrategy;
            }
        );

        $this->app->singleton(
            TieAthleteRaceStrategy::class,
            function ($app) use ($generator, $propertyAccessor, $min, $max) {

                $tieStrategy = new TieAthleteRaceStrategy();

                $tieStrategy
                    ->setIntegerGenerator($generator)
                    ->setMin($min)
                    ->setMax($max)
                    ->setPropertyAccessor($propertyAccessor);
            }
        );

        $strategies = [
            OvertakeAthleteRaceStrategy::class,
            SequentialAthleteRaceStrategy::class,
            TieAthleteRaceStrategy::class,
        ];

        $this->app->tag($strategies, 'strategies');

        $this->app->singleton(
            AthleteRetrievalStrategy::class,
            function ($app) {

                $entityManager = $app->make('Doctrine\ORM\EntityManagerInterface');
                $min = $this->options['batch_athlete_retrieval_min_threshold'];
                $max = $this->options['batch_athlete_retrieval_max_threshold'];
                $generator = $app->make(RandomIntegerGenerator::class);
                $repository = $entityManager->getRepository(Athlete::class);

                $strategy = new AthleteRetrievalStrategy();

                $strategy
                    ->setEntityManager($entityManager)
                    ->setMin($min)
                    ->setMax($max)
                    ->setRandomIntegerGenerator($generator)
                    ->setRepository($repository);

                return $strategy;
            }
        );
    }

    protected function registerFactories()
    {
        $this->app->singleton(
            AthleteRaceStrategyFactory::class,
            function ($app) {

                $strategies = $app->tagged('strategies');

                $factory = new AthleteRaceStrategyFactory();

                $factory->setStrategies($strategies);

                return $factory;
            }
        );
    }
}
