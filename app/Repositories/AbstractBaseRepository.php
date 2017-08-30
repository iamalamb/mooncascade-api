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
    public function getCount(array $criteria = [])
    {
        $query = $this
            ->createQueryBuilder('c')
            ->select('COUNT(c)');

        if ($criteria) {

            foreach ($criteria as $key => $val) {

                if ($val === null) {

                    $query->where('c.'.$key.' IS NULL');
                } else {
                    $query->where('c.'.$key.' = :'.$key)
                        ->setParameter($key, $val);
                }

            }
        }

        return $query
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
