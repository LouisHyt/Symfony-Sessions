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

    public function findAvailableModules($session_id): array
    {

        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();
        $qb = $sub;
        $qb->select('m')
            ->from('App\Entity\Module', 'm')
            ->leftJoin('m.programs', 'pr')
            ->leftJoin('pr.session', 'se')
            ->where('se.id = :id');
        
        $sub = $em->createQueryBuilder();

        $sub->select('mo')
            ->from('App\Entity\Module', 'mo')
            ->where($sub->expr()->notIn('mo.id', $qb->getDQL()))
            ->setParameter('id', $session_id)
            ->orderBy('mo.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;

        $query = $sub->getQuery();
        return $query->getResult();
    }

    private function getTotalSessions(): int
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    private function getLastCreatedSession(): string
    {
        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();
        $qb = $sub;
        $qb->select('MAX(s.id)')
            ->from('App\Entity\Session', 's');
        
        $sub = $em->createQueryBuilder();

        $sub->select('i.name')
            ->from('App\Entity\Session', 'i')
            ->where($sub->expr()->in('i.id', $qb->getDQL()))
        ;

        $query = $sub->getQuery();
        return $query->getSingleScalarResult();
    }


    private function getUpcomingSessionsCount(): int
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->where('s.beginDate > :date')
            ->setParameter('date', new \DateTime())
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    private function getOnGoingSessionsCount(): int
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->where('s.beginDate < :date AND s.endDate > :date')
            ->setParameter('date', new \DateTime())
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    private function getFinishedSessionsCount(): int
    {
        return $this->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->where('s.endDate < :date')
            ->setParameter('date', new \DateTime())
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function getGlobalInfos()
    {
        return [
            'totalSessions' => $this->getTotalSessions(),
            'lastCreatedSession' => $this->getLastCreatedSession(),
            'upcomingSessionsCount' => $this->getUpcomingSessionsCount(),
            'onGoingSessionsCount' => $this->getOnGoingSessionsCount(),
            'finishedSessionsCount' => $this->getFinishedSessionsCount()
        ];
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
