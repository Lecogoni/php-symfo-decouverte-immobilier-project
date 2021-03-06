<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query as Query;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{

  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Property::class);
  }


  /**
   * Take a PropertySearch as params
   * return a query - all propertis in sell with firter from PropertySearch applied
   */
  public function findAllInSell(PropertySearch $search): Query
  {

    # on défini notre query
    $query = $this->findAllNotSold();

    if ($search->getMaxPrice()) {
      $query = $query
        ->andWhere('p.price <= :maxprice')
        ->setParameter('maxprice', $search->getMaxPrice());
    }

    if ($search->getMinSurface()) {
      $query = $query
        ->andWhere('p.surface >= :minsurface')
        ->setParameter('minsurface', $search->getMinSurface());
    }

    return $query->getQuery();
  }


  /**
   * return all propertis in sell - limit result at 4
   */
  public function findLatest(): array
  {
    // automatically knows to select Products
    // the "p" is an alias you'll use in the rest of the query
    return $this->findAllNotSold()
      ->setMaxResults(4)
      ->getQuery()
      ->getResult();
  }


  /**
   * return all properties not sold
   */
  private function findAllNotSold(): ORMQueryBuilder
  {
    // the "p" is an alias you'll use in the rest of the query
    return $this->createQueryBuilder('p')
      ->where('p.sold = false');
  }


  // /**
  //  * @return Property[] Returns an array of Property objects
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
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
