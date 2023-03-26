<?php

namespace App\Repository;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Series;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function add(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByAuthorId(int $authorId): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.authors = :authorId')
            ->setParameter('authorId', $authorId)
            ->getQuery()
            ->getResult();
    }

    public function findAllGreaterThenPageCount(int $pageCount): array
    {
        $query = $this->_em->createQuery(
            'SELECT *
                FROM App\Entity\Book
                WHERE pageCount > :pageCount'
        )->setParameter('pageCount', $pageCount);

        return $query->getResult();
    }

    public function findByAuthorIdAndPageCount(int $authorId, int $pageCount): array
    {
        $rsm = (new ResultSetMapping())
            ->addEntityResult(Book::class, 'b')
            ->addFieldResult('b', 'book_id', 'id')
            ->addFieldResult('b', 'book_name', 'name')
            ->addFieldResult('b', 'book_pages', 'pageCount')
            ->addJoinedEntityResult(Series::class, 's', 'b', 'series')
            ->addFieldResult('s', 'series_id', 'id')
            ->addFieldResult('s', 'series_name', 'name')
            ->addJoinedEntityResult(Author::class, 'a', 'b', 'authors')
            ->addFieldResult('a', 'author_id', 'id')
            ->addFieldResult('a', 'author_fio', 'fio')
            ->addFieldResult('a', 'author_birthday', 'birthday');

        $sql = 'SELECT *
        FROM book b
        LEFT JOIN series s on s.id = b.series_id
        INNER JOIN book_author ba on ba.book_id = b.id
        INNER JOIN author a on a.id = ba.author_id
        WHERE a.id = :authorId and b.page_count > :pageCount';

        return $this->_em->createNativeQuery($sql, $rsm)
            ->setParameter('authorId', $authorId)
            ->setParameter('pageCount', $pageCount)
            ->getResult();
    }

    public function findBySeriesId(int $seriesId): array
    {
        $conn = $this->_em->getConnection();

        $sql = 'SELECT *
        FROM book b
        INNER JOIN book_author ba on ba.book_id = b.id
        INNER JOIN author a on a.id = ba.author_id
        WHERE b.series_id = :seriesId';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }
}
