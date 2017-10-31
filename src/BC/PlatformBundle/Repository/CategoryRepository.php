<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 27/10/17
 * Time: 09:51
 */

namespace BC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function getLikeQueryBuilder($pattern)
    {
        return $this
            ->createQueryBuilder('c')
            ->where('c.name LIKE :pattern')
            ->setParameter('pattern', $pattern);
    }
}