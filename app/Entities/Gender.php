<?php

namespace Mooncascade\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Illuminate\Support\Collection;
use Mooncascade\Traits\IDAsIntegerTrait;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * Class Team
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 *
 * @ORM\Entity(repositoryClass="Mooncascade\Repositories\GenderRepository")
 * @ORM\Table("genders")
 */
class Gender
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
     * One Gender has many Athlete instances
     *
     * @var PersistentCollection
     *
     * @ORM\OneToMany(targetEntity="Athlete", mappedBy="gender")
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
     * @return Gender
     */
    public function setName(string $name): Gender
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
     */
    public function setAthletes(PersistentCollection $athletes)
    {
        $this->athletes = $athletes;
    }
}
