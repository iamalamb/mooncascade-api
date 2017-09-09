<?php

namespace Mooncascade\Providers;

use Illuminate\Support\ServiceProvider;
use Mooncascade\Entities\Athlete;
use Mooncascade\Factories\AthleteRaceStrategyFactory;
use Mooncascade\Generators\RandomIntegerGenerator;
use Mooncascade\Generators\RandomRaceStrategyEventGenerator;
use Mooncascade\Handlers\BatchEntityCollectionHandler;
use Mooncascade\Serializers\JSONSerializer;
use Mooncascade\Strategies\AthleteRetrievalStrategy;
use Mooncascade\Strategies\OvertakeAthleteRaceStrategy;
use Mooncascade\Strategies\SequentialAthleteRaceStrategy;
use Mooncascade\Strategies\TieAthleteRaceStrategy;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\XmlFileLoader;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class MooncascadeServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * Uses a Symony OptionsResolver
     * to ensure that all configuration
     * options are correctly wired up.
     */
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
    }

    /**
     * Register the various strategies used
     * within the app
     */
    protected function registerStrategies()
    {

        // ALL strategies make use of the RandomIntegerGenerator
        $generator = $this->app->make(RandomIntegerGenerator::class);
        $propertyAccessor = new PropertyAccessor();

        // Get the min/max thresholds for delaying athletes
        $min = $this->options['delay_athlete_execution_min_threshold'];
        $max = $this->options['delay_athlete_execution_min_threshold'];

        // Register the OvertakeAthleteRaceStrategy
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

        // Register the SequentialAthleteRaceStrategy
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

        // Register the SequentialAthleteRaceStrategy
        $this->app->singleton(
            TieAthleteRaceStrategy::class,
            function ($app) use ($generator, $propertyAccessor, $min, $max) {

                $tieStrategy = new TieAthleteRaceStrategy();

                $tieStrategy
                    ->setIntegerGenerator($generator)
                    ->setMin($min)
                    ->setMax($max)
                    ->setPropertyAccessor($propertyAccessor);

                return $tieStrategy;
            }
        );

        // Register the AthleteRetrievalStrategy
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
                    ->setMin($min)
                    ->setMax($max)
                    ->setRandomIntegerGenerator($generator)
                    ->setRepository($repository);

                return $strategy;
            }
        );
    }

    /**
     * Registers the AthleteRaceStrategyFactory
     */
    protected function registerFactories()
    {
        $this->app->singleton(
            AthleteRaceStrategyFactory::class,
            function ($app) {

                $strategies = [
                    'overtake'   => $app->make(OvertakeAthleteRaceStrategy::class),
                    'sequential' => $app->make(SequentialAthleteRaceStrategy::class),
                    'tie'        => $app->make(TieAthleteRaceStrategy::class),
                ];

                $factory = new AthleteRaceStrategyFactory();

                $factory->setStrategies($strategies);

                return $factory;
            }
        );
    }

    /**
     * Registers the BatchEntityCollectionHandler
     */
    protected function registerHandlers()
    {
        $this->app->singleton(
            BatchEntityCollectionHandler::class,
            function ($app) {

                $handler = new BatchEntityCollectionHandler();
                $generator = $app->make(RandomRaceStrategyEventGenerator::class);

                $handler->setRandomRaceStrategyEventGenerator($generator);

                return $handler;
            }
        );
    }

    protected function registerSerializers()
    {
        $this->app->singleton(
            JSONSerializer::class,
            function ($app) {

                $classMetaDataFactory = new ClassMetadataFactory(
                    new XmlFileLoader(base_path().'/serializers/entities.xml')
                );

                $snakeCaseConverter = new CamelCaseToSnakeCaseNameConverter();

                $objectNormalizier = new ObjectNormalizer($classMetaDataFactory, $snakeCaseConverter);
                $objectNormalizier->setCircularReferenceHandler(
                    function ($object) {
                        return $object->getId();
                    }
                );

                $dateTimeNormalizer = new DateTimeNormalizer();

                $normalizers = [$dateTimeNormalizer, $objectNormalizier];

                $encoders = [new JsonEncoder()];

                $serializer = new Serializer($normalizers, $encoders);

                $jsonSerializer = new JSONSerializer();
                $jsonSerializer->setSerializer($serializer);

                return $jsonSerializer;
            }
        );
    }
}
