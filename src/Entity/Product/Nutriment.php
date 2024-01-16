<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product\Unit;


#[ORM\Entity]
#[ORM\Table(name: "nutriment")]
class Nutriment {
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "nutriment_id", type: "integer", nullable: false)]
    private int $id;

    #[ORM\Column(name: "nutriment_name", type: "string", length: 30, nullable: false)]
    private string $name;

    #[ORM\OneToMany(targetEntity: Unit::class, mappedBy: "nutriment")]
    #[ORM\JoinColumn(name: "unit_id", referencedColumnName: "unit_id")]
    private $unit;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}