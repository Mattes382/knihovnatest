<?php

namespace App\Entity;

use App\Repository\KnihyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=KnihyRepository::class)
 *
 */
class Knihy
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $nazev;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detail;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     *     maxSize = "100k"
     * )
     * @Assert\Length(
     *     max="100"
     * )
     */
    private $obrazek;


    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="kniha")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity=Zanry::class, inversedBy="Knihy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $zanry;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $rokvydani;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThan(0)
     */
    private $pocetstranek;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->zanry = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNazev(): ?string
    {
        return $this->nazev;
    }

    public function setNazev(string $nazev): self
    {
        $this->nazev = $nazev;

        return $this;
    }


    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    public function getObrazek(): ?string
    {
        return $this->obrazek;
    }

    public function setObrazek(string $obrazek): self
    {
        $this->obrazek = $obrazek;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Zanry[]
     */
    public function getZanry(): Collection
    {
        return $this->zanry;
    }

    public function addZanry(Zanry $zanry): self
    {
        if (!$this->zanry->contains($zanry)) {
            $this->zanry[] = $zanry;
        }

        return $this;
    }

    public function removeZanry(Zanry $zanry): self
    {
        if ($this->zanry->contains($zanry)) {
            $this->zanry->removeElement($zanry);
        }

        return $this;
    }

    public function getRokvydani(): ?int
    {
        return $this->rokvydani;
    }

    public function setRokvydani(int $rokvydani): self
    {
        $this->rokvydani = $rokvydani;

        return $this;
    }

    public function getPocetstranek(): ?int
    {
        return $this->pocetstranek;
    }

    public function setPocetstranek(int $pocetstranek): self
    {
        $this->pocetstranek = $pocetstranek;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


}
