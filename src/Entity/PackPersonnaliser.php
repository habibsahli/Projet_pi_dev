<?php
namespace App\Entity;

use App\Repository\PackPersonnaliserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackPersonnaliserRepository::class)]
class PackPersonnaliser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idPackPersonnaliser = null;

    #[ORM\ManyToOne(targetEntity: Pack::class)]
    #[ORM\JoinColumn(name: 'pack_id', referencedColumnName: 'id_pack')]
    private ?Pack $pack;

    #[ORM\ManyToOne(targetEntity: Programme::class)]
    #[ORM\JoinColumn(name: 'programme_id', referencedColumnName: 'id_prog')]
    private ?Programme $programme;

    public function getIdPackPersonnaliser(): ?int
    {
        return $this->idPackPersonnaliser;
    }

    public function getPack(): ?Pack
    {
        return $this->pack;
    }

    public function setPack(?Pack $pack): void
    {
        $this->pack = $pack;
    }

    public function getProgramme(): ?Programme
    {
        return $this->programme;
    }

    public function setProgramme(?Programme $programme): void
    {
        $this->programme = $programme;
    }
}
