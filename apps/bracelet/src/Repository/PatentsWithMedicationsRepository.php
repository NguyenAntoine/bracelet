<?php

namespace App\Repository;

use App\Entity\PatentsWithMedications;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PatentsWithMedications|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatentsWithMedications|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatentsWithMedications[]    findAll()
 * @method PatentsWithMedications[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatentsWithMedicationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PatentsWithMedications::class);
    }

    // /**
    //  * @return PatentsWithMedications[] Returns an array of PatentsWithMedications objects
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
    public function findOneBySomeField($value): ?PatentsWithMedications
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
