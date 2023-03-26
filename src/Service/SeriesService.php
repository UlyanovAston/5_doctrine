<?php

namespace App\Service;

use App\DTO\Request\SeriesSaveDTO;
use App\Entity\Series;
use Doctrine\ORM\EntityManagerInterface;

class SeriesService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    /**
     * @return array<Series>
     */
    public function getAll(): array
    {
        return $this->entityManager->getRepository(Series::class)->findAll();
    }

    public function save(SeriesSaveDTO $requestData): Series
    {
        $series = (new Series())
            ->setName($requestData->getName());

        return $series;
    }
}
