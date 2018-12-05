<?php

namespace App\Repository;

use App\Entity\Validate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Validate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Validate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Validate[]    findAll()
 * @method Validate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValidateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Validate::class);
    }

    // /**
    //  * @return Validate[] Returns an array of Validate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Validate
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
