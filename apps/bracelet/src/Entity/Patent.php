<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatentRepository")
 */
class Patent
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
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Type("string")
     */
    private $last_name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Disease")
     * @JMS\Exclude()
     */
    private $diseases;

    /**
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\PatentsWithMedications",
     *     mappedBy="patent",
     *     orphanRemoval=true,
     *     cascade={"all"}
     * )
     * @JMS\Type("App\Entity\PatentsWithMedications")
     */
    private $medications;

    public function __construct()
    {
        $this->diseases = new ArrayCollection();
        $this->medications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * @return Collection|Disease[]
     */
    public function getDiseases(): Collection
    {
        return $this->diseases;
    }

    public function addDisease(Disease $disease): self
    {
        if (!$this->diseases->contains($disease)) {
            $this->diseases[] = $disease;
        }

        return $this;
    }

    public function removeDisease(Disease $disease): self
    {
        if ($this->diseases->contains($disease)) {
            $this->diseases->removeElement($disease);
        }

        return $this;
    }

    /**
     * @return Collection|PatentsWithMedications[]
     */
    public function getMedications(): Collection
    {
        return $this->medications;
    }

    public function addMedication(PatentsWithMedications $medication): self
    {
        if (!$this->medications->contains($medication)) {
            $this->medications[] = $medication;
            $medication->setPatent($this);
        }

        return $this;
    }

    public function removeMedication(PatentsWithMedications $medication): self
    {
        if ($this->medications->contains($medication)) {
            $this->medications->removeElement($medication);
            // set the owning side to null (unless already changed)
            if ($medication->getPatent() === $this) {
                $medication->setPatent(null);
            }
        }

        return $this;
    }
}
