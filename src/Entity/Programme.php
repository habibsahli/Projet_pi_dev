<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]
class Programme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_prog", type: "integer")]
    private ?int $id_prog;

    #[ORM\Column(name: "image", type: "string", length: 255)]
    private ?string $image = null;

    #[ORM\Column(name: "duree", type: "datetime")]
    private ?\DateTimeInterface $duree = null;

    #[ORM\Column(name: "description_programme")]
    private $descriptionProgramme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;

    public function getId_prog(): ?int
    {
        return $this->id_prog;
    }

  

    public function getDescriptionProgramme(): ?string
    {
        return $this->descriptionProgramme;
    }

    public function setDescriptionProgramme(string $descriptionProgramme): self
    {
        $this->descriptionProgramme = $descriptionProgramme;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;
        return $this;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }
}
