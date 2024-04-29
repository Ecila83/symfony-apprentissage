<?php

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Todo>
 *
 * @method Todo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Todo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Todo[]    findAll()
 * @method Todo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    public function findAllWithPriorityMoreThan($priority)
    {
        return $this->createQueryBuilder('t')
                    ->where('t.priority > :priority')
                    ->setParameter('priority', $priority)
                    ->andWhere('t.done != false')
                    ->setMaxResults(3)
                    ->orderBy('t.content', 'DESC')
                    ->getQuery()
                    ->getResult();
    }

    public function findAllWithPriorityMoreThanDKL($priority, EntityManager $em){

        $query =$em->createQuery('SELECT t FROM App\Entity\Todo t WHERE t.priority > :priority AND t.done != false ORDER BY t.content ASC')->setMaxResults(2);
        return $query->execute(['priority'=> $priority]);

    }

    //    /**
    //     * @return Todo[] Returns an array of Todo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Todo
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
