<?php

namespace Tests\Feature;

use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Entities\Team;
use Tests\TestCase;

class TeamRepositoryTest extends TestCase
{
    protected $repository;

    /**
     * Initial setup to ensure a fresh repository each time
     */
    protected function setUp()
    {
        parent::setUp();

        $this->repository = EntityManager::getRepository(Team::class);
    }


    /**
     * Test to ensure that the findOneByRandom function correctly returns
     * a single Team instance.
     *
     * @return void
     */
    public function testfindOneByRandomReturnsASingleRandomInstance()
    {
        $entity = $this->repository->findOneByRandom();
        $this->assertInstanceOf(Team::class, $entity);
    }
}
