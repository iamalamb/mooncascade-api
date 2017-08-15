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
    public function findOneByRandom()
    {
        $total = $this
            ->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->getQuery()
            ->getSingleScalarResult();

        return $this
            ->createQueryBuilder('c')
            ->setFirstResult(rand(0, $total - 1))
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }
}
