<?php

namespace App\Service;

use App\Entity\Book;
use App\Repository\BookRepository;

class BookService
{
    public function __construct(
        private BookRepository $repository
    ) {}

    /**
     * @return array<Book>
     */
    public function getAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @return array<Book>
     */
    public function getByAuthorId(int $authorId): array
    {
        return $this->repository->findByAuthorId($authorId);
    }

    /**
     * @return array<Book>
     */
    public function getGreaterThenPageCount(int $pageCount): array
    {
        return $this->repository->findAllGreaterThenPageCount($pageCount);
    }

    /**
     * @return array<Book>
     */
    public function getByAuthorIdAndGreaterThenPageCount(int $authorId, int $pageCount): array
    {
        return $this->repository->findByAuthorIdAndPageCount($authorId, $pageCount);
    }

    public function getBySeriesId(int $seriesId): array
    {
        return $this->repository->findBySeriesId($seriesId);
    }
}
