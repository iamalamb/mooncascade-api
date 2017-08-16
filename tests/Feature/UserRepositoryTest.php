<?php

namespace Tests\Feature;

use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Repositories\AbstractBaseRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Mooncascade\Repositories\UserRepository;
use Mooncascade\Entities\User;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * Initial setup to ensure a fresh repository each time
     */
    protected function setUp()
    {
        parent::setUp();

        $this->repository = EntityManager::getRepository(User::class);
    }

    /**
     * Test to ensure that appropriate parent classes and interfaces are
     * correctly applied.
     */
    public function testThatRepositoryIsCorrectType()
    {
        $this->assertInstanceOf(UserRepository::class, $this->repository);
        $this->assertInstanceOf(AbstractBaseRepository::class, $this->repository);
        $this->assertInstanceOf(EntityRepository::class, $this->repository);
        $this->assertInstanceOf(ObjectRepository::class, $this->repository);
    }

    /**
     * Test to ensure that the getCount function returns the correct
     * value based on the 'testing' environment settings.
     */
    public function testGetCountReturnsCorrectValue()
    {
        $count = $this->repository->getCount();
        $this->assertEquals(1, $count);
    }

    /**
     * Test to ensure that the findOneByRandom function correctly returns
     * a single User instance.
     *
     * @return void
     */
    public function testfindOneByRandomReturnsASingleRandomInstance()
    {
        $entity = $this->repository->findOneByRandom();
        $this->assertInstanceOf(User::class, $entity);
    }
}
