<?php

namespace Tests\Feature;

use LaravelDoctrine\ORM\Facades\EntityManager;
use Mooncascade\Repositories\AbstractBaseRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ObjectRepository;
use Mooncascade\Repositories\GenderRepository;
use Mooncascade\Entities\Gender;
use Tests\TestCase;

class GenderRepositoryTest extends TestCase
{
    /**
     * @var GenderRepository
     */
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
     * Test to ensure that appropriate parent classes and interfaces are
     * correctly applied.
     */
    public function testThatRepositoryIsCorrectType()
    {
        $this->assertInstanceOf(GenderRepository::class, $this->repository);
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
        $this->assertEquals(2, $count);
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
