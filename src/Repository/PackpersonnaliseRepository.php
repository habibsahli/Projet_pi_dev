<?php

namespace App\Repository;

use App\Entity\Packpersonnalise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Packpersonnalise>
 *
 * @method Packpersonnalise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Packpersonnalise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Packpersonnalise[]    findAll()
 * @method Packpersonnalise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackpersonnaliseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Packpersonnalise::class);
    }

//    /**
//     * @return Packpersonnalise[] Returns an array of Packpersonnalise objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Packpersonnalise
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}
