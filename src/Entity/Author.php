<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 * @UniqueEntity("jmeno")
 *
 */
class Author
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
    private $jmeno;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $info;

    /**
     * @ORM\OneToMany(targetEntity=Knihy::class, mappedBy="author")
     *
     */
    private $kniha;

    public function __construct()
    {
        $this->kniha = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJmeno(): ?string
    {
        return $this->jmeno;
    }

    public function setJmeno(string $jmeno): self
    {
        $this->jmeno = $jmeno;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(?string $info): self
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @return Collection|Knihy[]
     */
    public function getKniha(): Collection
    {
        return $this->kniha;
    }

    public function addKniha(Knihy $kniha): self
    {
        if (!$this->kniha->contains($kniha)) {
            $this->kniha[] = $kniha;
            $kniha->setAuthor($this);
        }

        return $this;
    }

    public function removeKniha(Knihy $kniha): self
    {
        if ($this->kniha->contains($kniha)) {
            $this->kniha->removeElement($kniha);
            // set the owning side to null (unless already changed)
            if ($kniha->getAuthor() === $this) {
                $kniha->setAuthor(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->jmeno;
    }
}
