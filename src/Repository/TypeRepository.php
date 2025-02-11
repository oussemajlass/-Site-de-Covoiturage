<?php

namespace App\Repository;

use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Type|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type[]    findAll()
 * @method Type[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    // Exemple de méthode personnalisée : trouver des types par un critère spécifique
    public function findByCriteria($criteria)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.criteriaField = :criteria')
            ->setParameter('criteria', $criteria)
            ->getQuery()
            ->getResult();
    }

    // Exemple de méthode personnalisée : récupérer tous les types triés par un certain champ
    public function findAllOrderedBy($orderBy = 'name')
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.' . $orderBy, 'ASC')
            ->getQuery()
            ->getResult();
    }
}