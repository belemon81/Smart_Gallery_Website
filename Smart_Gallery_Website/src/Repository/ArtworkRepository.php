<?php

namespace App\Repository;

use App\Entity\Artwork;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Artwork>
 *
 * @method Artwork|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artwork|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artwork[]    findAll()
 * @method Artwork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Artwork[]    findByCategory(array $category)
 * @method Artwork[]    findByCategoryAndIsApprovedAndTotalViews(array $categories)
 */
class ArtworkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artwork::class);
    }

    public function save(Artwork $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Artwork $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Artwork[]
     */
    public function findByCategory(Collection $categories)
    {
        $qb = $this->createQueryBuilder("c")
            ->where(':Category MEMBER OF c.Category')
            ->setParameters(array('Category' => $categories));
        // $entityManager = $this->getEntityManager();
        return $qb->getQuery()->getResult();
    }

    /**
     * @return Artwork[]
     */
    public function findByCategoryAndIsApprovedAndTotalViews(Collection $categories, int $id)
    {
        if ($id != -1) {
            $max = 13;
            $offset= 12 * $id;
        } else {
            $max = 30;
            $offset = 0;
        }
        $qb = $this->createQueryBuilder('a') // Use 'a' as alias for Artwork
            ->where('a.Approved = true')
            ->andWhere(':Category MEMBER OF a.Category')
            ->orderBy('a.TotalViews', 'DESC')
            ->setParameters(array('Category' => $categories))
            ->setMaxResults($max)
            ->setFirstResult($offset);
        return $qb->getQuery()->getResult();
    }

    /**
     * @return Artwork[]
     */
    public function findByNameAndCategoryAndIsApprovedAndTotalViews(string $name, Collection $categories)
    {
        $qb = $this->createQueryBuilder('a') // Use 'a' as alias for Artwork
            ->where('a.Approved = true')
            ->andWhere('a.Name = :Name')
            ->andWhere(':Category MEMBER OF a.Category')
            ->orderBy('a.TotalViews', 'DESC')
            ->setParameters(array('Category' => $categories, 'Name' => $name))
            ->setMaxResults(30);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Artwork[]
     */
    public function findByNameAndArtistAndCategoryAndIsApprovedAndTotalViews(string $name, User $artist, Collection $categories)
    {
        $qb = $this->createQueryBuilder('a') // Use 'a' as alias for Artwork
            ->where('a.Approved = true')
            ->andWhere('a.Name = :Name')
            ->andWhere('a.Artist = :Artist')
            ->andWhere(':Category MEMBER OF a.Category')
            ->orderBy('a.TotalViews', 'DESC')
            ->setParameters(array('Category' => $categories, 'Name' => $name, 'Artist' => $artist))
            ->setMaxResults(30);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Artwork[]
     */
    public function findByArtistAndCategoryAndIsApprovedAndTotalViews(User $artist, Collection $categories)
    {
        $qb = $this->createQueryBuilder('a') // Use 'a' as alias for Artwork
            ->where('a.Approved = true')
            ->andWhere('a.Artist = :Artist')
            ->andWhere(':Category MEMBER OF a.Category')
            ->orderBy('a.TotalViews', 'DESC')
            ->setParameters(array('Category' => $categories, 'Artist' => $artist))
            ->setMaxResults(30);

        return $qb->getQuery()->getResult();
    }


    //    /**
    //     * @return Artwork[] Returns an array of Artwork objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Artwork
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
