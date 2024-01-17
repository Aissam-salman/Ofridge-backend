<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "nutriscore")]
class Nutriscore
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "nutriscore_id", type: "integer")]
    private $id;

    #[ORM\Column(name: "nutriscore_grade", type: "string", length: 2)]
    private $grade;

    #[ORM\Column("nutriscore_created_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $createdAt;
    #[ORM\Column("nutriscore_updated_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;
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
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

}
