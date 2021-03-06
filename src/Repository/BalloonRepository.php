<?php

namespace App\Repository;

use App\Entity\Balloon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Balloon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Balloon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Balloon[]    findAll()
 * @method Balloon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BalloonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Balloon::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('b')
            ->where('b.something = :value')->setParameter('value', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findAllActive()
    {
        return $this->createQueryBuilder('balloon')
            ->andWhere('balloon.isActive = :value')->setParameter('value', true)
            ->orderBy('balloon.name', 'ASC');
    }

//    public function getUsedBaloonsInYear($year)
//    {
//        return $this->createQueryBuilder('balloon')
//            ->leftJoin('balloon.decorationItems', 'decoration_items')
//            ->leftJoin('decoration_items.decoration', 'decoration')
//            ->leftJoin('decoration.celebration', 'celebration');
//    }
}
