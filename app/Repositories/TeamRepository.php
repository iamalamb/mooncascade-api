<?php

namespace Mooncascade\Repositories;

/**
 * Class TeamRepository
 *
 * @author Jason Lamb <jlamb@iamalamb.com>
 */
class TeamRepository extends AbstractBaseRepository
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
