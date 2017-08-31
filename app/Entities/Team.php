<?php

namespace Mooncascade\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Illuminate\Support\Collection;
use Mooncascade\Traits\IDAsIntegerTrait;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @var PersistentCollection
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
     * @return PersistentCollection
     */
    public function getAthletes(): PersistentCollection
    {
        return $this->athletes;
    }

    /**
     * @param PersistentCollection $athletes
     * @return Team
     */
    public function setAthletes(PersistentCollection $athletes): Team
    {
        $this->athletes = $athletes;

        return $this;
    }
}
