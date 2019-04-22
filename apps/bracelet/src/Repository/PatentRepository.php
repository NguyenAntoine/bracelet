<?php

namespace App\Repository;

use App\Entity\Patent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Patent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patent[]    findAll()
 * @method Patent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Patent::class);
    }

    // /**
    //  * @return Patent[] Returns an array of Patent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Patent
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
