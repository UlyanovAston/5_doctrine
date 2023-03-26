<?php

namespace App\Controller;

use App\Entity\Book;
use App\Service\BookService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BooksController extends BaseController
{
    public function __construct(
        private BookService $service,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        parent::__construct($serializer, $validator);
    }

    public function index(): JsonResponse
    {
        return $this->json([
            'books' => $this->service->getAll(),
        ]);
    }

    public function filterByAuthor(int $authorId): JsonResponse
    {
        return $this->json([
            'books' => $this->service->getByAuthorId($authorId),
        ]);
    }

    public function filterByPageCount(int $pageCount): JsonResponse
    {
        return $this->json([
            'books' => $this->service->getGreaterThenPageCount($pageCount),
        ]);
    }

    public function filterByAuthorAndPageCount(int $authorId, int $pageCount): JsonResponse
    {
        return $this->json([
            'books' => $this->service->getByAuthorIdAndGreaterThenPageCount($authorId, $pageCount),
        ]);
    }

    public function filterBySeries(int $seriesId): JsonResponse
    {
        return $this->json([
            'books' => $this->service->getBySeriesId($seriesId),
        ]);
    }
}
