<?php
/**
 * @Author Rajerison Julien <julienrajerison5@gmail.com>
 * @Description Demo Todo Techzara du 27 - 04 - 2019
 */

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Todo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Todo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Todo[]    findAll()
 * @method Todo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    /**
     * @return Todo[] Returns an array of Todo objects
     */
    public function findTodoFin()
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.todo_is_fin = :val')
            ->setParameter('val', true)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param $status
     *
     * @return Todo[] Returns an array of Todo objects
     */
    public function findByStatus($status)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.todo_status = :val')
            ->andWhere('t.todo_is_fin = :bool')
            ->setParameter('val', $status)
            ->setParameter('bool', 0)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    /*
    public function findOneBySomeField($value): ?Todo
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
