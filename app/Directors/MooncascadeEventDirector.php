<?php

namespace Mooncascade\Directors;

use Mooncascade\Builders\MooncascadeEventBuilderInterface;
use Illuminate\Contracts\Config\Repository as Config;
use Mooncascade\Managers\MooncascadeEventManagerInterface;

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
class MooncascadeEventDirector
{
    /**
     * @var MooncascadeEventBuilderInterface
     */
    protected $builder;

    /**
     * @var Config
     */
    protected $config;

    /**
     * MooncascadeEventDirector constructor.
     * @param MooncascadeEventBuilderInterface $builder
     * @param Config $config
     */
    public function __construct(MooncascadeEventBuilderInterface $builder, Config $config)
    {
        $this->builder = $builder;
        $this->config = $config;
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

    }
}
