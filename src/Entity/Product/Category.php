<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "category")]
class Category {
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"IDENTITY")]
    #[ORM\Column(name: "category_id",type: "integer")]
    private int $id;

    #[ORM\Column(name: "category_name",type: "string", length: 50, nullable: false)]
    private string $name;

    #[ORM\Column(name: "category_created_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $createdAt;
    #[ORM\Column(name: "category_updated_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $categoryId): self
    {
        $this->id = $categoryId;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $pName): self
    {
        $this->name = $pName;
        return $this;
    }

    public function getCreatedAt():?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeInterface $pCreatedAt): self
    {
        $this->createdAt = $pCreatedAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }
    public function setUpdatedAt(\DateTimeInterface $pUpdatedAt): self
    {
        $this->updatedAt = $pUpdatedAt;
        return $this;
    }
}