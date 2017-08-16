<?php

namespace Tests\Feature;

use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Repositories\AbstractBaseRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Mooncascade\Repositories\TeamRepository;
use Mooncascade\Entities\Team;
use Tests\TestCase;

class TeamRepositoryTest extends TestCase
{
    /**
     * @var TeamRepository
     */
    protected $repository;


    /**
     * Initial setup to ensure a fresh repository each time
     */
    protected function setUp()
    {
        parent::setUp();

        $this->repository = EntityManager::getRepository(Team::class);
    }

    public function testThatRepositoryIsCorrectType()
    {
        $this->assertInstanceOf(TeamRepository::class, $this->repository);
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
        $this->assertEquals(5, $count);
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
