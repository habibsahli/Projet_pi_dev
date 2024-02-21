<?php

namespace App\Entity;

 
use App\Repository\TypepackRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypepackRepository::class)]
class Typepack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_typepack")]
    private ?int $idTypepack = null;

    #[ORM\Column(name: "nomTypePack", length: 255)]
    private ?string $nomTypePack = null;

    public function getIdTypepack(): ?int
    {
        return $this->idTypepack;
    }

    public function getNomTypePack(): ?string
    {
        return $this->nomTypePack;
    }

    public function setNomTypePack(string $nomTypePack): self
    {
        $this->nomTypePack = $nomTypePack;
        return $this;
    }

}
