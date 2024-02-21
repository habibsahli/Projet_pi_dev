<?php

namespace App\Repository;

use App\Entity\PackPersonnaliser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PackPersonnaliser>
 *
 * @method PackPersonnaliser|null find($id, $lockMode = null, $lockVersion = null)
 * @method PackPersonnaliser|null findOneBy(array $criteria, array $orderBy = null)
 * @method PackPersonnaliser[]    findAll()
 * @method PackPersonnaliser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackPersonnaliserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PackPersonnaliser::class);
    }

//    /**
//     * @return PackPersonnaliser[] Returns an array of PackPersonnaliser objects
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

//    public function findOneBySomeField($value): ?PackPersonnaliser
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
