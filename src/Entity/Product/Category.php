<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "category")]
class Category {
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"AUTO")]
    #[ORM\Column(name: "category_id",type: "integer")]
    private int $id;

    #[ORM\Column(name: "category_name",type: "string", length: 50, nullable: false)]
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $categoryId): self
    {
        $this->id = $categoryId;
        return $this;
    }

    public function getName():?string
    {
        return $this->name;
    }
    public function setName(string $pName): self
    {
        $this->name = $pName;
        return $this;
    }

}