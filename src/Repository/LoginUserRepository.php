<?php

namespace App\Repository;

use App\Entity\LoginUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LoginUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method LoginUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method LoginUser[]    findAll()
 * @method LoginUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoginUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LoginUser::class);
    }

    // /**
    //  * @return LoginUser[] Returns an array of LoginUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LoginUser
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
