<?php

namespace App\Repository;

use App\Entity\PatentMedication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PatentMedication|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatentMedication|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatentMedication[]    findAll()
 * @method PatentMedication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatentMedicationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PatentMedication::class);
    }

    // /**
    //  * @return PatentMedication[] Returns an array of PatentMedication objects
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
    public function findOneBySomeField($value): ?PatentMedication
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
