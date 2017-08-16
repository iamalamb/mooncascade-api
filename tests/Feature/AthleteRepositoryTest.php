<?php

namespace Tests\Feature;

use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Repositories\AbstractBaseRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Mooncascade\Repositories\AthleteRepository;
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

    public function testThatRepositoryIsCorrectType()
    {
        $this->assertInstanceOf(AthleteRepository::class, $this->repository);
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
        $this->assertEquals(50, $count);
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
