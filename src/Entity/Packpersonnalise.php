<?php

namespace App\Entity;

use App\Repository\PackpersonnaliseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Typepack;

#[ORM\Entity(repositoryClass: PackpersonnaliseRepository::class)]
class Packpersonnalise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id_packperso")]
    private ?int $Id_packperso = null;

    #[ORM\Column(name: "Nom_packperso", length: 255)]
    private ?string $Nom_packperso = null;

    #[ORM\Column(name: "Description_pack", length: 255)]
    private ?string $Description_pack = null;

    #[ORM\Column(name: "prix")]
    private ?float $Prix = null;

    #[ORM\Column(name: "Date", type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\Column(name: "Image", length: 255)]
    private ?string $Image = null;

    #[ORM\ManyToOne(targetEntity: Typepack::class)]
#[ORM\JoinColumn(name: "id_typepack", referencedColumnName: "id_typepack", nullable: false)]
private ?Typepack $Type_pack = null;

    public function getId_packperso(): ?int
    {
        return $this->Id_packperso;
    }

    public function getNomPackperso(): ?string
    {
        return $this->Nom_packperso;
    }

    public function setNomPackperso(string $Nom_packperso): static
    {
        $this->Nom_packperso = $Nom_packperso;

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
    // Vous devez adapter cette logique en fonction de la relation entre PackPersonnalise et TypePack
    // Supposons que vous avez une relation ManyToOne avec TypePack et que le champ correspondant est typePack
    // Dans ce cas, vous pouvez accéder au nom du type de pack ainsi :
    return $this->Type_pack ? $this->Type_pack->getNomTypePack() : null; // Assurez-vous que getNomTypePack() existe dans votre entité TypePack
}

    public function setTypePack(?Typepack $Type_pack): static
    {
        $this->Type_pack = $Type_pack;

        return $this;
    }
}
