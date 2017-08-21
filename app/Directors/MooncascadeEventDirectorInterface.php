<?php

namespace Mooncascade\Directors;

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
interface MooncascadeEventDirectorInterface
{
    /**
     * Responsible for instructing the
     * MooncascadeEventBuilderInterface to
     * construct the MooncascadeEventManagerInterface
     */
    public function buildEventManager();

    /**
     * Retrieve the constructed MooncascadeEventManagerInterface
     * from the MooncascadeEventBuilderInterface
     */
    public function getEventManager(): MooncascadeEventManagerInterface;

    public function configureOptions(array $options);
}