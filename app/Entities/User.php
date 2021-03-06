<?php

namespace Mooncascade\Entities;

use Doctrine\ORM\Mapping as ORM;
use Mooncascade\Traits\IDAsIntegerTrait;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * Class User
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 *
 * @ORM\Entity(repositoryClass="Mooncascade\Repositories\UserRepository")
 * @ORM\Table("users")
 */
class User
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
     * References the email address used to authenticate a User
     *
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    protected $email;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName(string $name): User
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }


}
