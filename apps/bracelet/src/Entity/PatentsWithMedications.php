<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatentsWithMedicationsRepository")
 * @UniqueEntity(
 *     fields={"patent", "patent_medication"},
 *     errorPath="patent_medication",
 *     message="This medication is already used by the patent."
 * )
 */
class PatentsWithMedications
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @JMS\Exclude()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patent", inversedBy="medications")
     * @ORM\JoinColumn(nullable=false)
     * @JMS\Exclude()
     */
    private $patent;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\PatentMedication", inversedBy="patent")
     * @ORM\JoinColumn(nullable=false)
     * @JMS\Type("App\Entity\PatentMedication")
     */
    private $patent_medication;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MedicationTaken", inversedBy="patentsWithMedications")
     * @ORM\OrderBy({"taken_at" = "ASC"})
     * @JMS\Exclude()
     */
    private $medication_taken;

    public function __construct()
    {
        $this->medication_taken = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatent(): ?Patent
    {
        return $this->patent;
    }

    public function setPatent(?Patent $patent): self
    {
        $this->patent = $patent;

        return $this;
    }

    public function getPatentMedication(): ?PatentMedication
    {
        return $this->patent_medication;
    }

    public function setPatentMedication(?PatentMedication $patent_medication): self
    {
        $this->patent_medication = $patent_medication;

        return $this;
    }

    /**
     * @return Collection|MedicationTaken[]
     */
    public function getMedicationTaken(): Collection
    {
        return $this->medication_taken;
    }

    public function addMedicationTaken(MedicationTaken $medicationTaken): self
    {
        if (!$this->medication_taken->contains($medicationTaken)) {
            $this->medication_taken[] = $medicationTaken;
        }

        return $this;
    }

    public function removeMedicationTaken(MedicationTaken $medicationTaken): self
    {
        if ($this->medication_taken->contains($medicationTaken)) {
            $this->medication_taken->removeElement($medicationTaken);
        }

        return $this;
    }
}
