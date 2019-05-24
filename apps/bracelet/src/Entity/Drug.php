<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\PatentMedication", inversedBy="drugs")
     * @JMS\Exclude()
     */
    private $patents;

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

    public function getPatents(): ?PatentMedication
    {
        return $this->patents;
    }

    public function setPatents(?PatentMedication $patents): self
    {
        $this->patents = $patents;

        return $this;
    }
}
