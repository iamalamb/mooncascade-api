<?php

namespace Tests\Unit;

use Mooncascade\Managers\MooncascadeEventManager;
use Mooncascade\Builders\MooncascadeEventBuilder;
use Mooncascade\Directors\MooncascadeEventDirector;
use Symfony\Component\Console\Exception\InvalidOptionException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tests\TestCase;

class MooncascadeEventDirectorTest extends TestCase
{
    /**
     * Runs tests against the configureOptions method
     * to ensure that the options are resolved correctly
     *
     * @return void
     */
    public function testDirectorConfigureOptionsMethodExecutesCorrectly()
    {
        $options = [
            'delay_race_start'                      => true,
            'delay_race_start_time'                 => 60,
            'delay_athlete_execution_min_threshold' => 5,
            'delay_athlete_execution_max_threshold' => 10,
        ];

        $eventManager = $this->createMock(MooncascadeEventManager::class);

        $builder = $this
            ->getMockBuilder(MooncascadeEventBuilder::class)
            ->setConstructorArgs([$eventManager])
            ->getMock();

        $optionsResolver = new OptionsResolver();

        $director = new MooncascadeEventDirector($builder, [], $optionsResolver);

        $this->assertEquals(null, $director->configureOptions($options));
    }

    public function testDirectorConfigureOptionsThrowsValidExceptions()
    {
        $eventManager = $this->createMock(MooncascadeEventManager::class);

        $builder = $this
            ->getMockBuilder(MooncascadeEventBuilder::class)
            ->setConstructorArgs([$eventManager])
            ->getMock();

        $optionsResolver = new OptionsResolver();

        $director = new MooncascadeEventDirector($builder, [], $optionsResolver);

        $this->expectException(MissingOptionsException::class);

        $options = [
            'delay_race_start_time'                 => 60,
            'delay_athlete_execution_min_threshold' => 5,
            'delay_athlete_execution_max_threshold' => 10,
        ];

        $director->configureOptions($options);

        $options = [
            'delay_race_start'                      => true,
            'delay_athlete_execution_min_threshold' => 5,
            'delay_athlete_execution_max_threshold' => 10,
        ];

        $director->configureOptions($options);

        $options = [
            'delay_race_start'                      => true,
            'delay_race_start_time'                 => 60,
            'delay_athlete_execution_max_threshold' => 10,
        ];

        $director->configureOptions($options);

        $options = [
            'delay_race_start'                      => true,
            'delay_race_start_time'                 => 60,
            'delay_athlete_execution_min_threshold' => 5,
        ];

        $director->configureOptions($options);

        $this->expectException(InvalidOptionException::class);

        $options = [
            'delay_race_start'                      => '123',
            'delay_race_start_time'                 => true,
            'delay_athlete_execution_min_threshold' => '123',
            'delay_athlete_execution_max_threshold' => 10.5,
        ];

        $director->configureOptions($options);

        $this->expectException(UndefinedOptionsException::class);

        $options = [
            'bogus_option_that_throws_exception'    => '123'
        ];

        $director->configureOptions($options);
    }

    public function testGetEventManagerReturnsValidManager()
    {
        $eventManager = $this->createMock(MooncascadeEventManager::class);

        $builder = new MooncascadeEventBuilder($eventManager);

        $optionsResolver = new OptionsResolver();

        $director = new MooncascadeEventDirector($builder, [], $optionsResolver);

        $this->assertInstanceOf(MooncascadeEventManager::class, $director->getEventManager());
    }
}
