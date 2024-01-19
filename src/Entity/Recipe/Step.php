<?php

namespace App\Entity\Recipe;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: "step")]
class Step {



    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "step_id", type: "integer")]
    private int $id;


    #[ORM\Column(name: "step_name", type: "string", length: 50)]
    private string $stepName;

    #[ORM\Column(name: "step_description", type: "string", length: 50)]
    private string $stepDescription;



    #[ORM\Column(name: "step_created_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $createdAt;
    #[ORM\Column(name: "step_updated_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $updatedAt;





    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getStepName(): ?string
    {
        return $this->stepName;
    }


    public function setStepName(string $pName): self
    {
        $this->stepName = $pName;
        return $this;
    }

    public function getStepDescription(): ?string
    {
        return $this->stepDescription;
    }


    public function setStepDescription(string $pDescription): self
    {
        $this->stepDescription = $pDescription;
        return $this;
    }


    public function getCreatedAt():?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt():?\DateTimeInterface
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(\DateTimeInterface $pUpdatedAt): self
    {
        $this->updatedAt = $pUpdatedAt;
        return $this;
    }
}
