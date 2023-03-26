<?php

namespace App\Controller;

use App\DTO\Request\AuthorSaveDTO;
use App\Service\AuthorService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthorsController extends BaseController
{
    public function __construct(
        private AuthorService $service,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        parent::__construct($serializer, $validator);
    }

    public function index(): JsonResponse
    {
        return $this->json([
            'authors' => $this->service->getAll(),
        ]);
    }

    public function save(Request $request): JsonResponse
    {
        /** @var AuthorSaveDTO $requestData */
        $requestData = $this->getRequestObject($request, AuthorSaveDTO::class);
        $author = $this->service->save($requestData);

        return $this->json($author, Response::HTTP_CREATED);
    }
}
