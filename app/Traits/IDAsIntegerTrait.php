<?php

namespace Mooncascade\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait IDAsIntegerTrait
 *
 * @package Mooncascade\Traits
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
trait IDAsIntegerTrait
{
    /**
     * Generic auto-generated ID column
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * Getter method for the auto-generated ID column
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
