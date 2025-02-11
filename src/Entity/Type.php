<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")] // Spécifiez le type de la colonne
    private ?int $id = null;
    public function getId(): ?int
    {
        return $this->id;
    }
}
