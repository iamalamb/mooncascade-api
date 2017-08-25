<?php

namespace Mooncascade\Entities;

use Doctrine\ORM\Mapping as ORM;
use Mooncascade\Traits\IDAsIntegerTrait;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * Class Team
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 *
 * @ORM\Entity(repositoryClass="Mooncascade\Repositories\TeamRepository")
 * @ORM\Table("teams")
 */
class Team
{
    use IDAsIntegerTrait, Timestamps;

    /**
     * References the name of a logged in User
     *
     * @var string
     *
     * @ORM\Column(type="string", length=125, nullable=false)
     */
    protected $name;


    /**
     * One Team has many Athlete instances
     *
     * @var Athlete[]
     *
     * @ORM\OneToMany(targetEntity="Athlete", mappedBy="team")
     */
    protected $athletes;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Team
     */
    public function setName(string $name): Team
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Athlete[]
     */
    public function getAthletes(): array
    {
        return $this->athletes;
    }

    /**
     * @param Athlete[] $athletes
     * @return Team
     */
    public function setAthletes(array $athletes): Team
    {
        $this->athletes = $athletes;

        return $this;
    }
}
