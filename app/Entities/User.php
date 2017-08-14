<?php

namespace Mooncascade\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 *
 * @ORM\Entity
 * @ORM\Table("users")
 */
class User
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
     * References the name of a logged in User
     *
     * @var string
     *
     * @ORM\Column(type="string", length=25, nullable=false)
     */
    protected $name;

    /**
     * References the email address used to authenticate a User
     *
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    protected $email;


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
