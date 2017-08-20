<?php

namespace Mooncascade\Builders;

use Mooncascade\Managers\MooncascadeEventManagerInterface;

/**
 * Class MooncascadeEventBuilder
 *
 * Builder component responsible for constructing the
 * MooncascadeEventManager.
 *
 * Based on the Builder design pattern.
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 * @see https://sourcemaking.com/design_patterns/builder
 */
class MooncascadeEventBuilder implements MooncascadeEventBuilderInterface
{
    /**
     * @var MooncascadeEventManagerInterface
     */
    protected $eventManager;

    /**
     * MooncascadeEventBuilder constructor.
     * @param MooncascadeEventManagerInterface $eventManager
     */
    public function __construct(MooncascadeEventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * @return MooncascadeEventManagerInterface
     */
    public function getEventManager(): MooncascadeEventManagerInterface
    {
        return $this->eventManager;
    }

}
