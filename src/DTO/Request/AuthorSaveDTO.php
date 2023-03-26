<?php

namespace App\DTO\Request;

use Symfony\Component\Validator\Constraints as Assert;

class AuthorSaveDTO
{
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private string $name;

    #[Assert\NotBlank]
    #[Assert\Type("string")]
    #[Assert\Date]
    private string $birthday;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }
}
