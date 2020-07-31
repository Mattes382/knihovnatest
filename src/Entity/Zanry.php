<?php

namespace App\Entity;

use App\Repository\ZanryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZanryRepository::class)
 */
class Zanry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nazev;

    /**
     * @ORM\ManyToMany(targetEntity=Knihy::class, mappedBy="zanry")
     */
    private $Knihy;

    public function __construct()
    {
        $this->Knihy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->Nazev;
    }

    public function setNazev(string $Nazev): self
    {
        $this->Nazev = $Nazev;

        return $this;
    }

    /**
     * @return Collection|Knihy[]
     */
    public function getKnihy(): Collection
    {
        return $this->Knihy;
    }

    public function addKnihy(Knihy $knihy): self
    {
        if (!$this->Knihy->contains($knihy)) {
            $this->Knihy[] = $knihy;
            $knihy->addZanry($this);
        }

        return $this;
    }

    public function removeKnihy(Knihy $knihy): self
    {
        if ($this->Knihy->contains($knihy)) {
            $this->Knihy->removeElement($knihy);
            $knihy->removeZanry($this);
        }

        return $this;
    }
}
