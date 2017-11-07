<?php

namespace App\Models\Repository;

use App\Models\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends EntityRepository
{
    /**
     * @param array $fields
     * @return User[]
     */
    public function findByFields(array $fields) : array
    {
        /** @var QueryBuilder $qb */
        $qb = $this->getEntityManager()
            ->getRepository('App\Models\User')
            ->createQueryBuilder('u');

        foreach ($fields as $param => $value) {
            if(strpos($value, '|') === false){
                $qb->andWhere("u.{$param} = :{$param}")->setParameter($param, $value);
            }else{
                [$valueFrom, $valueTo] = explode('|', $value);
                $qb->andWhere("u.{$param} > :{$param}_from")->setParameter($param . '_from', $valueFrom);
                $qb->andWhere("u.{$param} < :{$param}_to")->setParameter($param . '_to', $valueTo);
            }
        }

        $query = $qb->getQuery();
        return $query->getResult();

    }

}