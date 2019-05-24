<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DrugRepository")
 */
class Drug
{
    use Timestamp;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @JMS\Exclude()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Type("string")
     */
    private $no_drug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Type("string")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Type("string")
     */
    private $injection_type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PatentMedication", mappedBy="drug")
     * @JMS\Exclude()
     */
    private $patents;

    /**
     * Drug constructor.
     */
    public function __construct()
    {
        $this->patents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNoDrug(): ?string
    {
        return $this->no_drug;
    }

    public function setNoDrug(string $no_drug): self
    {
        $this->no_drug = $no_drug;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getInjectionType(): ?string
    {
        return $this->injection_type;
    }

    public function setInjectionType(?string $injection_type): self
    {
        $this->injection_type = $injection_type;

        return $this;
    }

    /**
     * @return Collection|PatentMedication[]
     */
    public function getPatents(): Collection
    {
        return $this->patents;
    }

    public function addPatent(PatentMedication $patent): self
    {
        if (!$this->patents->contains($patent)) {
            $this->patents[] = $patent;
            $patent->setDrug($this);
        }

        return $this;
    }

    public function removePatent(PatentMedication $patent): self
    {
        if ($this->patents->contains($patent)) {
            $this->patents->removeElement($patent);
            // set the owning side to null (unless already changed)
            if ($patent->getDrug() === $this) {
                $patent->setDrug(null);
            }
        }

        return $this;
    }
}
