<?php

namespace App\Repository;

use App\Entity\VisitationTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VisitationTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisitationTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisitationTask[]    findAll()
 * @method VisitationTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitationTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisitationTask::class);
    }

    // /**
    //  * @return VisitationTask[] Returns an array of VisitationTask objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VisitationTask
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
