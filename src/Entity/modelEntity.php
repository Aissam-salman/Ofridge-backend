<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Truc")]
class truc
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"AUTO")]
    #[ORM\Column(name: "truc_id", type: "integer")]
    private $id;

    #[ORM\Column(name: "truc_grade", type: "string", length: 2)]
    private $grade;

    // Getters and Setters

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
}
