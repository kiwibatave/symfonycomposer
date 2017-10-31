<?php

namespace BC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ApplicationRepository extends \Doctrine\ORM\EntityRepository
{
    public function getApplicationsWithAdvert($limit)
    {
        $qb = $this->createQueryBuilder('a');
//        On crée la jointure avec l'entité Advert pour aliais "adv"
        $qb
            ->innerJoin('a.advert', 'adv')
            ->addSelect('adv');
//        Puis on retourne que $limit résultats
        $qb->setMaxResults('$limit');
//        Et l'on retourne le résultat
        return $qb
            ->getQuery()
            ->getResult();
    }
}
