<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "country")]
class Country {
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "country_id", type: "integer", nullable: false)]
    private int $id;

    #[ORM\Column(name: "country_name", type: "string", length: 30, nullable: false)]
    private string $name;

    #[ORM\Column(name: "country_created_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $createdAt;
    #[ORM\Column(name: "country_updated_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $updatedAt;

    public function getId():?int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName():?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
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
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}