<?php

/*
 * This file is part of the TestVagrant Project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CommentRepository
 */
class CommentRepository extends EntityRepository
{
    /**
     * @param bool $status
     *
     * @return array
     */
    public function findOneBetweenDateAndType($status)
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.status = :status')
            ->setParameter('status', $status);

        return $qb->getQuery()->getResult();
    }
}
