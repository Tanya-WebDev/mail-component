<?php

namespace App\Domain\Repository;

use App\Domain\Entity\FeedbackEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FeedbackEmail>
 *
 * @method FeedbackEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method FeedbackEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method FeedbackEmail[]    findAll()
 * @method FeedbackEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedbackEmailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeedbackEmail::class);
    }

    public function save(FeedbackEmail $feedbackEmail): void
    {
        $this->getEntityManager()->persist($feedbackEmail);
        $this->getEntityManager()->flush();
    }

//    /**
//     * @return FeedbackEmail[] Returns an array of FeedbackEmail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FeedbackEmail
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
