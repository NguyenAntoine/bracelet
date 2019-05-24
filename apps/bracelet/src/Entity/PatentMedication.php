<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatentMedicationRepository")
 */
class   PatentMedication
{
    use Timestamp;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Type("string")
     */
    private $schedule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Type("string")
     */
    private $meal_period;

    /**
     * @ORM\Column(type="integer")
     * @JMS\Type("integer")
     */
    private $number;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @JMS\Type("integer")
     */
    private $weeks_duration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @JMS\Type("integer")
     */
    private $months_duration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @JMS\Type("integer")
     */
    private $per_day;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @JMS\Type("integer")
     */
    private $per_week;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @JMS\Type("integer")
     */
    private $per_month;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Patent", mappedBy="medication")
     * @JMS\Exclude()
     */
    private $patents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Drug", mappedBy="patents")
     * @JMS\Type("array<App\Entity\Drug>")
     */
    private $drugs;

    public function __construct()
    {
        $this->patents = new ArrayCollection();
        $this->drugs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(?string $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getMealPeriod(): ?string
    {
        return $this->meal_period;
    }

    public function setMealPeriod(?string $meal_period): self
    {
        $this->meal_period = $meal_period;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getWeeksDuration(): ?int
    {
        return $this->weeks_duration;
    }

    public function setWeeksDuration(?int $weeks_duration): self
    {
        $this->weeks_duration = $weeks_duration;

        return $this;
    }

    public function getMonthsDuration(): ?int
    {
        return $this->months_duration;
    }

    public function setMonthsDuration(?int $months_duration): self
    {
        $this->months_duration = $months_duration;

        return $this;
    }

    public function getPerDay(): ?int
    {
        return $this->per_day;
    }

    public function setPerDay(?int $per_day): self
    {
        $this->per_day = $per_day;

        return $this;
    }

    public function getPerWeek(): ?int
    {
        return $this->per_week;
    }

    public function setPerWeek(?int $per_week): self
    {
        $this->per_week = $per_week;

        return $this;
    }

    public function getPerMonth(): ?int
    {
        return $this->per_month;
    }

    public function setPerMonth(?int $per_month): self
    {
        $this->per_month = $per_month;

        return $this;
    }

    /**
     * @return Collection|Patent[]
     */
    public function getPatents(): Collection
    {
        return $this->patents;
    }

    public function addPatent(Patent $patent): self
    {
        if (!$this->patents->contains($patent)) {
            $this->patents[] = $patent;
            $patent->setMedication($this);
        }

        return $this;
    }

    public function removePatent(Patent $patent): self
    {
        if ($this->patents->contains($patent)) {
            $this->patents->removeElement($patent);
            // set the owning side to null (unless already changed)
            if ($patent->getMedication() === $this) {
                $patent->setMedication(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Drug[]
     */
    public function getDrugs(): Collection
    {
        return $this->drugs;
    }

    public function addDrug(Drug $drug): self
    {
        if (!$this->drugs->contains($drug)) {
            $this->drugs[] = $drug;
            $drug->setPatents($this);
        }

        return $this;
    }

    public function removeDrug(Drug $drug): self
    {
        if ($this->drugs->contains($drug)) {
            $this->drugs->removeElement($drug);
            // set the owning side to null (unless already changed)
            if ($drug->getPatents() === $this) {
                $drug->setPatents(null);
            }
        }

        return $this;
    }
}
