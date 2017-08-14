<?php

namespace Mooncascade\Entities;

use Doctrine\ORM\Mapping as ORM;
use Mooncascade\Traits\IDAsIntegerTrait;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * Class Athlete
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="athletes")
 */
class Athlete
{
    use IDAsIntegerTrait, Timestamps;

    /**
     * References the unique code ID of
     * the timing device.
     *
     * @var string
     *
     * @ORM\Column(type="guid", nullable=false, unique=true)
     */
    protected $code;

    /**
     * References the name of a competing Athlete
     *
     * @var string
     *
     * @ORM\Column(type="string", length=125, nullable=false)
     */
    protected $name;

    /**
     * References the starting number of an Athlete
     *
     * @var integer
     *
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint", nullable=false, unique=true, options={"unsigned"=false})
     */
    protected $startNumber;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Athlete
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Athlete
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getStartNumber()
    {
        return $this->startNumber;
    }

    /**
     * @param int $startNumber
     * @return Athlete
     */
    public function setStartNumber($startNumber)
    {
        $this->startNumber = $startNumber;

        return $this;
    }
}
