<?php

namespace App\Repository;

use App\Entity\Training;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Training>
 */
class TrainingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Training::class);
    }

    public function getLastTrainings(): array
    {
        return $this->createQueryBuilder('t')
        ->select(
                't.name as name', 
                 'COUNT(DISTINCT se.id) AS sessionCount', 
                 'COUNT(DISTINCT pr.id) AS moduleCount', 
                 'COUNT(DISTINCT itr.id) AS internCount',
                 'COUNT(DISTINCT tra.id) AS trainerCount',
                 'SUM(DISTINCT pr.totalDays) AS totalDays')
        ->leftJoin('t.sessions', 'se')
        ->leftJoin('se.trainer', 'tra')
        ->leftJoin('se.programs', 'pr')
        ->leftJoin('pr.module', 'mo')
        ->leftJoin('se.interns', 'itr')
        ->groupBy('t.id')
        ->orderBy('sessionCount', 'DESC')
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();
    }

//    /**
//     * @return Training[] Returns an array of Training objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Training
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
