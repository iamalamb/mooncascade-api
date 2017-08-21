<?php

namespace Mooncascade\Directors;

use Mooncascade\Builders\MooncascadeEventBuilderInterface;
use Mooncascade\Managers\MooncascadeEventManagerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MooncascadeEventDirector
 *
 * Director component responsible for ensuring the
 * MooncascadeEventBuilder constructs the MooncascadeEventManager.
 *
 * Also used to retrieve the constructed EventManager.
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 * @see https://sourcemaking.com/design_patterns/builder
 */
class MooncascadeEventDirector implements MooncascadeEventDirectorInterface
{
    /**
     * @var MooncascadeEventBuilderInterface
     */
    protected $builder;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * MooncascadeEventDirector constructor.
     * @param MooncascadeEventBuilderInterface $builder
     * @param array $options
     * @param OptionsResolver $optionsResolver
     */
    public function __construct(
        MooncascadeEventBuilderInterface $builder,
        array $options,
        OptionsResolver $optionsResolver
    ) {
        $this->builder = $builder;
        $this->options = $options;
        $this->optionsResolver = $optionsResolver;
    }

    /**
     * Responsible for instructing the
     * MooncascadeEventBuilderInterface to
     * construct the MooncascadeEventManagerInterface
     */
    public function buildEventManager()
    {

    }

    /**
     * Retrieve the constructed MooncascadeEventManagerInterface
     * from the MooncascadeEventBuilderInterface
     */
    public function getEventManager(): MooncascadeEventManagerInterface
    {
        return $this->builder->getEventManager();
    }

    /**
     * Used to ensure that the correct options
     * are retrieved and available.
     *
     * @param array $options
     */
    public function configureOptions(array $options)
    {
        // Set the options that NEED to be available
        $required = [
            'delay_race_start',
            'delay_race_start_time',
            'delay_athlete_execution_min_threshold',
            'delay_athlete_execution_max_threshold',
        ];

        $this->optionsResolver->setRequired($required);

        // Set the allowed types
        $this->optionsResolver->setAllowedTypes('delay_race_start', 'boolean');
        $this->optionsResolver->setAllowedTypes('delay_race_start_time', 'integer');
        $this->optionsResolver->setAllowedTypes('delay_athlete_execution_min_threshold', 'integer');
        $this->optionsResolver->setAllowedTypes('delay_athlete_execution_max_threshold', 'integer');

        $this->optionsResolver->resolve($options);
    }
}
