<?php

namespace Mooncascade\Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class AbstractBaseRepository
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
abstract class AbstractBaseRepository extends EntityRepository
{
    /**
     * Retrieve the count of a given
     * Entity/table.
     *
     * @return mixed
     */
    public function getCount()
    {
        return $this
            ->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Retrieve an random Entity instance
     *
     * @return mixed
     */
    public function findOneByRandom()
    {
        $total = $this->getCount();

        return $this
            ->createQueryBuilder('c')
            ->setFirstResult(rand(0, $total - 1))
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }
}
