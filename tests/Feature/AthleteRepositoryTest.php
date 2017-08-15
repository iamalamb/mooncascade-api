<?php

namespace Tests\Feature;

use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Entities\Athlete;
use Tests\TestCase;

class AthleteRepositoryTest extends TestCase
{
    protected $repository;

    /**
     * Initial setup to ensure a fresh repository each time
     */
    protected function setUp()
    {
        parent::setUp();

        $this->repository = EntityManager::getRepository(Athlete::class);
    }

    /**
     * Test to ensure that the findOneByRandom function correctly returns
     * a single Athlete instance.
     *
     * @return void
     */
    public function testfindOneByRandomReturnsASingleRandomInstance()
    {
        $entity = $this->repository->findOneByRandom();
        $this->assertInstanceOf(Athlete::class, $entity);
    }
}
