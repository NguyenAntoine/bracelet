<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicationTakenRepository")
 */
class MedicationTaken
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @JMS\Exclude()
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     * @JMS\Type("boolean")
     */
    private $taken;

    /**
     * @ORM\Column(type="datetime")
     * @JMS\Type("DateTime")
     */
    private $taken_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PatentsWithMedications", mappedBy="medication_taken")
     * @JMS\Type("App\Entity\PatentsWithMedications")
     */
    private $patentsWithMedications;

    public function __construct()
    {
        $this->patentsWithMedications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaken(): ?bool
    {
        return $this->taken;
    }

    public function setTaken(bool $taken): self
    {
        $this->taken = $taken;

        return $this;
    }

    public function getTakenAt(): ?\DateTimeInterface
    {
        return $this->taken_at;
    }

    public function setTakenAt(\DateTimeInterface $taken_at): self
    {
        $this->taken_at = $taken_at;

        return $this;
    }

    /**
     * @return Collection|PatentsWithMedications[]
     */
    public function getPatentsWithMedications(): Collection
    {
        return $this->patentsWithMedications;
    }

    public function addPatentsWithMedication(PatentsWithMedications $patentsWithMedication): self
    {
        if (!$this->patentsWithMedications->contains($patentsWithMedication)) {
            $this->patentsWithMedications[] = $patentsWithMedication;
            $patentsWithMedication->addMedicationTaken($this);
        }

        return $this;
    }

    public function removePatentsWithMedication(PatentsWithMedications $patentsWithMedication): self
    {
        if ($this->patentsWithMedications->contains($patentsWithMedication)) {
            $this->patentsWithMedications->removeElement($patentsWithMedication);
            $patentsWithMedication->removeMedicationTaken($this);
        }

        return $this;
    }
}
