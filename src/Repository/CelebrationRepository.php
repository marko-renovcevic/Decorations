<?php

namespace App\Repository;

use App\Entity\Celebration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Celebration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Celebration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Celebration[]    findAll()
 * @method Celebration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CelebrationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Celebration::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
