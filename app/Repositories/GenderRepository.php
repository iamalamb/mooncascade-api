<?php

namespace Mooncascade\Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * Class GenderRepository
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class GenderRepository extends EntityRepository
{
    public function findOneByRandom()
    {
        $total = $this
            ->createQueryBuilder('g')
            ->select('COUNT(g)')
            ->getQuery()
            ->getSingleScalarResult();

        return $this
            ->createQueryBuilder('g')
            ->setFirstResult(rand(0, $total - 1))
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }
}
