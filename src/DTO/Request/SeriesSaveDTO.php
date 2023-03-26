<?php

namespace App\DTO\Request;

use Symfony\Component\Validator\Constraints as Assert;

class SeriesSaveDTO
{
    #[Assert\NotBlank]
    #[Assert\Type("string")]
    private string $name;

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
}
