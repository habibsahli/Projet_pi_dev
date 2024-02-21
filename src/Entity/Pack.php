<?php

namespace App\Entity;
use App\Entity\Typepack;
use App\Repository\PackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id] // Annotation pour indiquer que cette propriété est une clé primaire
    #[ORM\GeneratedValue] // Annotation pour indiquer que la valeur de cette propriété est générée automatiquement
    #[ORM\Column] // Annotation pour indiquer que cette propriété est mappée à une colonne de la table
    private ?int $id_pack = null; // Déclaration de la propriété avec un type nullable (int)

    #[ORM\Column(length: 255)] // Annotation pour indiquer les détails de la colonne dans la base de données
    private ?string $nom_pack = null; // Déclaration de la propriété avec un type nullable (string)

    #[ORM\Column(length: 255)] // Annotation pour indiquer les détails de la colonne dans la base de données
    private ?string $Description_pack = null; // Déclaration de la propriété avec un type nullable (string)

    #[ORM\Column] // Annotation pour indiquer les détails de la colonne dans la base de données
    private ?float $Prix = null; // Déclaration de la propriété avec un type nullable (float)

    #[ORM\Column(type: Types::DATE_MUTABLE)] // Annotation pour indiquer les détails de la colonne dans la base de données
    private ?\DateTimeInterface $Date = null; // Déclaration de la propriété avec un type nullable (\DateTimeInterface)

    #[ORM\Column(length: 255)] // Annotation pour indiquer les détails de la colonne dans la base de données
    private ?string $Image = null; // Déclaration de la propriété avec un type nullable (string)

    #[ORM\ManyToOne(targetEntity: Typepack::class)] // Annotation pour indiquer la relation ManyToOne avec l'entité Typepack
    #[ORM\JoinColumn(name: "id_typepack", referencedColumnName: "id_typepack", nullable: false)] // Annotation pour configurer la jointure
    private ?Typepack $Type_pack = null; // Déclaration de la propriété avec un type nullable (Typepack)

    // Les autres méthodes de l'entité Pack...

    // Méthodes getters et setters pour accéder et définir les valeurs des propriétés

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
        return $this->Type_pack ? $this->Type_pack->getNomTypePack() : null;
    }

    public function setTypePack(?Typepack $Type_pack): static
    {
        $this->Type_pack = $Type_pack;

        return $this;
    }
}
