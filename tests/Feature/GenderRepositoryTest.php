<?php

namespace Tests\Feature;

use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Entities\Gender;
use Tests\TestCase;

class GenderRepositoryTest extends TestCase
{
    protected $repository;

    /**
     * Initial setup to ensure a fresh repository each time
     */
    protected function setUp()
    {
        parent::setUp();

        $this->repository = EntityManager::getRepository(Gender::class);
    }


    /**
     * Test to ensure that the findOneByRandom function correctly returns
     * a single Gender instance.
     *
     * @return void
     */
    public function testfindOneByRandomReturnsASingleRandomInstance()
    {
        $entity = $this->repository->findOneByRandom();
        $this->assertInstanceOf(Gender::class, $entity);
    }
}
