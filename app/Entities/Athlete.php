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
class Athlete implements EntityInterface
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
     * Reference to the time the Athlete instance enters
     * the initial finishing gate
     *
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    protected $timeAtGate;

    /**
     * Reference to the time the Athlete instance
     * completed the event.
     *
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    protected $timeAtFinish;

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
     * Each Athlete belongs to a single Team
     *
     * @var Team
     *
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="athletes")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    protected $team;

    /**
     * The __toString method allows a class to decide how it will react when it is converted to a string.
     *
     * @return string
     * @link http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.tostring
     */
    public function __toString()
    {
        $parts = [
            $this->id,
            $this->name,
            $this->startNumber,
            $this->timeAtGate,
            $this->timeAtFinish
        ];

        return join('---', $parts);
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Athlete
     */
    public function setCode(string $code): Athlete
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Athlete
     */
    public function setName(string $name): Athlete
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth(): \DateTime
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     * @return Athlete
     */
    public function setDateOfBirth(\DateTime $dateOfBirth): Athlete
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @return int
     */
    public function getStartNumber(): int
    {
        return $this->startNumber;
    }

    /**
     * @param int $startNumber
     * @return Athlete
     */
    public function setStartNumber(int $startNumber): Athlete
    {
        $this->startNumber = $startNumber;

        return $this;
    }

    /**
     * @return float
     */
    public function getTimeAtGate(): ?float
    {
        return $this->timeAtGate;
    }

    /**
     * @param float $timeAtGate
     * @return Athlete
     */
    public function setTimeAtGate(float $timeAtGate): Athlete
    {
        $this->timeAtGate = $timeAtGate;

        return $this;
    }

    /**
     * @return float
     */
    public function getTimeAtFinish(): ?float
    {
        return $this->timeAtFinish;
    }

    /**
     * @param float $timeAtFinish
     * @return Athlete
     */
    public function setTimeAtFinish(float $timeAtFinish): Athlete
    {
        $this->timeAtFinish = $timeAtFinish;

        return $this;
    }

    /**
     * @return Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }

    /**
     * @param Gender $gender
     * @return Athlete
     */
    public function setGender(Gender $gender): Athlete
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @param Team $team
     * @return Athlete
     */
    public function setTeam(Team $team): Athlete
    {
        $this->team = $team;

        return $this;
    }
}
