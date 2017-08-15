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
 * @ORM\Entity(repositoryClass="Mooncascade\Repositories\AthleteRepository")
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
     * Reference to the Athlete's date of birth
     *
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    protected $dateOfBirth;

    /**
     * References the starting number of an Athlete
     *
     * @var integer
     *
     * @ORM\Column(type="bigint", nullable=false, unique=true, options={"unsigned"=false})
     */
    protected $startNumber;

    /**
     * Each Athlete has a single Gender
     *
     * @var Gender
     *
     * @ORM\ManyToOne(targetEntity="Gender", inversedBy="athletes")
     * @ORM\JoinColumn(name="gender_id", referencedColumnName="id")
     */
    protected $gender;

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
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
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

    /**
     * @return Gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param Gender $gender
     * @return Athlete
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }
}
