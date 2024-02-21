<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_pack = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_pack = null;

    #[ORM\Column(length: 255)]
    private ?string $Description_pack = null;

    #[ORM\Column]
    private ?float $Prix = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

    #[ORM\ManyToOne(targetEntity: Typepack::class)]
    #[ORM\JoinColumn(name: "id_typepack", referencedColumnName: "id_typepack", nullable: false)]
    private ?Typepack $Type_pack = null; // Spécifiez le type d'accès ici

    // Les autres méthodes de l'entité Pack...

  

    public function getId_pack(): ?int
    {
        return $this->id_pack;
    }

    public function getNomPack(): ?string
    {
        return $this->nom_pack;
    }

    public function setNomPack(string $nom_pack): static
    {
        $this->nom_pack = $nom_pack;

        return $this;
    }

    public function getDescriptionPack(): ?string
    {
        return $this->Description_pack;
    }

    public function setDescriptionPack(string $Description_pack): static
    {
        $this->Description_pack = $Description_pack;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    public function getTypePack(): ?string
    {
        // Vous devez adapter cette logique en fonction de la relation entre Pack et Typepack
        // Supposons que vous avez une relation ManyToOne avec Typepack et que le champ correspondant est Type_pack
        // Dans ce cas, vous pouvez accéder au nom du type de pack ainsi :
        return $this->Type_pack ? $this->Type_pack->getNomTypePack() : null; // Assurez-vous que getNomTypePack() existe dans votre entité Typepack
    }

    public function setTypePack(?Typepack $Type_pack): static
    {
        $this->Type_pack = $Type_pack;

        return $this;
    }

    
}
