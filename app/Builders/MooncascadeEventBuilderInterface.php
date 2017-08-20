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
interface MooncascadeEventBuilderInterface
{
    /**
     * Retrieve the contructed MooncascadeEventManagerInterface
     *
     * @return MooncascadeEventManagerInterface
     */
    public function getEventManager(): MooncascadeEventManagerInterface;
}