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
     * @ORM\Column(type="string", length=20, nullable=false)
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Gender
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Athlete[]
     */
    public function getAthletes()
    {
        return $this->athletes;
    }

    /**
     * @param Athlete[] $athletes
     */
    public function setAthletes($athletes)
    {
        $this->athletes = $athletes;
    }
}
