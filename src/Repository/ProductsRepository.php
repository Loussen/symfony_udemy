<?php

namespace App\Repository;

use App\Entity\Categories;
use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Products::class);
    }

    // /**
    //  * @return Products[] Returns an array of Products objects
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
    public function findOneBySomeField($value): ?Products
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;getGreateThan
    }
    */

    public function getGreateThan(int $price)
    {
        return $qb = $this->createQueryBuilder('u')
            ->andWhere('u.price > :price')
            ->setParameter('price',$price)
            ->orderBy('u.price','ASC')
            ->getQuery()
            ->getResult();
    }

    public function getByCategory(Categories $categories)
    {
        return $this->createQueryBuilder("p")
            ->andWhere("p.category = :category")
            ->setParameter("category",$categories)
            ->getQuery()
            ->getResult();
    }
}
