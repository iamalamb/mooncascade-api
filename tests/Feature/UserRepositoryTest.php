<?php

namespace Tests\Feature;

use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Entities\User;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
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
