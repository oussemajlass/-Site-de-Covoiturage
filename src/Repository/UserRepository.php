<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // Exemple de méthode personnalisée pour rechercher un utilisateur par son email
    public function findByEmail($email)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // Exemple de méthode personnalisée pour récupérer tous les utilisateurs triés par nom
    public function findAllOrderedByName()
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.lastName', 'ASC') // ou 'u.firstName' selon ce que vous souhaitez
            ->getQuery()
            ->getResult();
    }
}