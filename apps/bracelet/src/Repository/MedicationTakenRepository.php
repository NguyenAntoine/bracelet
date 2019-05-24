<?php

namespace App\Repository;

use App\Entity\MedicationTaken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MedicationTaken|null find($id, $lockMode = null, $lockVersion = null)
 * @method MedicationTaken|null findOneBy(array $criteria, array $orderBy = null)
 * @method MedicationTaken[]    findAll()
 * @method MedicationTaken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicationTakenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MedicationTaken::class);
    }

    // /**
    //  * @return MedicationTaken[] Returns an array of MedicationTaken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MedicationTaken
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
