<?php

namespace App\Models\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends EntityRepository
{
    public function findByFields(array $fields)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->getEntityManager()
            ->getRepository('App\Models\User')
            ->createQueryBuilder('u');

        foreach ($fields as $param => $value) {
            $qb->andWhere("u.{$param} = :{$param}")->setParameter($param, $value);
        }

        $query = $qb->getQuery();
        return $query->getResult();

    }

}