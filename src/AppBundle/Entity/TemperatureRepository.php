<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TemperatureRepository extends EntityRepository
{
    public function range(\DateTime $now)
    {
        $yesterday = clone $now;
        $yesterday->modify('-1 day');

        return $this->_em->createQueryBuilder()->select('t')
            ->from('AppBundle\Entity\Temperature', 't')
            ->where('t.roomId = :roomId')
            ->andWhere('t.date >= :startRange')
            ->andWhere('t.date <= :endRange')
            ->setParameter('roomId', 1)
            ->setParameter('endRange', $now->format('Y-m-d H:i:s'))
            ->setParameter('startRange', $yesterday->format('Y-m-d H:i:s'))
            ->setCacheable(true)
            ->getQuery();
    }

    public function findLatest()
    {
        return $this->_em->createQueryBuilder()
            ->select('t')
            ->from('AppBundle\Entity\Temperature', 't')
            ->orderBy('t.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
