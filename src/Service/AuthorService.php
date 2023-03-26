<?php

namespace App\Service;

use App\DTO\Request\AuthorSaveDTO;
use App\Entity\Author;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class AuthorService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    /**
     * @return array<Author>
     */
    public function getAll(): array
    {
        return $this->entityManager->getRepository(Author::class)->findAll();
    }

    public function save(AuthorSaveDTO $requestData): Author
    {
        $author = (new Author())
            ->setFio($requestData->getName())
            ->setBirthday(new DateTime($requestData->getBirthday()));

        $this->entityManager->persist($author);

        return $author;
    }
}
