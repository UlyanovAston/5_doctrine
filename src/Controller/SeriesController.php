<?php

namespace App\Controller;

use App\DTO\Request\SeriesSaveDTO;
use App\Service\SeriesService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SeriesController extends BaseController
{
    public function __construct(
        private SeriesService $service,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ) {
        parent::__construct($serializer, $validator);
    }

    public function index(): JsonResponse
    {
        return $this->json([
            'series' => $this->service->getAll(),
        ]);
    }

    public function save(Request $request): JsonResponse
    {
        /** @var SeriesSaveDTO $requestData */
        $requestData = $this->getRequestObject($request, SeriesSaveDTO::class);
        $service = $this->service->save($requestData);

        return $this->json($service, Response::HTTP_CREATED);
    }
}
