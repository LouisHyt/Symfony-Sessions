<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function findAvailableSessions(): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.training IS NULL')
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAvailableInterns($session_id): array
    {

        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();
        $qb = $sub;
        $qb->select('s')
            ->from('App\Entity\Intern', 's')
            ->leftJoin('s.sessions', 'se')
            ->where('se.id = :id');
        
        $sub = $em->createQueryBuilder();

        $sub->select('i')
            ->from('App\Entity\Intern', 'i')
            ->where($sub->expr()->notIn('i.id', $qb->getDQL()))
            ->setParameter('id', $session_id)
            ->orderBy('i.lastName', 'ASC')
            ->getQuery()
            ->getResult()
        ;

        $query = $sub->getQuery();
        return $query->getResult();
    }

//    /**
//     * @return Session[] Returns an array of Session objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Session
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
