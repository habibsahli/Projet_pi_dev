<?php

namespace App\Repository;

use App\Entity\Typepack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TypepackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Typepack::class);
    }

    /**
     * Recherche les Typepacks par un champ exemple.
     *
     * @param mixed $value La valeur à rechercher
     * @return Typepack[] Un tableau d'objets Typepack
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche un Typepack par un champ exemple.
     *
     * @param mixed $value La valeur à rechercher
     * @return Typepack|null Un objet Typepack ou null s'il n'est pas trouvé
     */
    public function findOneBySomeField($value): ?Typepack
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
