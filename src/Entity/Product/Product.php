<?php

namespace App\Entity\Product;

use Doctrine\DBAL\Types\BlobType;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product\Nutriscore as Nutriscore;
use App\Entity\Product\Category as Category;

#[ORM\Entity]
#[ORM\Table(name: 'product')]
class Product {
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"NONE")]
    #[ORM\Column(name: "product_code",type: "integer")]
    private int $id;

    #[ORM\Column(name: "product_name",type: "string", length: 70, nullable: false,unique: true)]
    private string $name;

    #[ORM\Column(name: "product_allergens_tags", type: "string", length: 70, nullable: false)]
    private string $allergens;

    #[ORM\Column(name: "product_brand_owner",type: "string", length: 50, nullable: false)]
    private string $brand;

    #[ORM\Column(name:"product_generic_name",type: "string", length: 50, nullable: false)]
    private string $genericName;

    #[ORM\Column(name:"product_img_front",type: "blob", nullable: false)]
    private BlobType $imgFront;

    #[ORM\Column(name:"product_packaging", type: "string")]
    private string $packaging;

    #[ORM\Column(name:"product_quantity", type: "float")]
    private float $quantity;

    #[ORM\ManyToOne(targetEntity: Nutriscore::class, inversedBy: "product")]
    #[ORM\JoinColumn(name: "nutriscore_id", referencedColumnName: "nutriscore_id")]
    private Nutriscore $nutriscore;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: "category")]
    #[ORM\JoinColumn(name: "category_id", referencedColumnName: "category_id")]
    private Category $category;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $pId): self
    {
        $this->id = $pId;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $pName): self
    {
        $this->name = $pName;
        return $this;
    }

    public function getAllergens(): ?string
    {
        return $this->allergens;
    }
    public function setAllergens(string $pAllergens): self
    {
        $this->allergens = $pAllergens;
        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }
    public function setBrand(string $pBrand): self
    {
        $this->brand = $pBrand;
        return $this;
    }

    public function getGenericName(): ?string
    {
        return $this->genericName;
    }
    public function setGenericName(string $pGenericName): self
    {
        $this->genericName = $pGenericName;
        return $this;
    }

    public function getImgFront(): ?BlobType
    {
        return $this->imgFront;
    }
    public function setImgFront(BlobType $pImgFront): self
    {
        $this->imgFront = $pImgFront;
        return $this;
    }

    public function getPackaging(): ?string
    {
        return $this->packaging;
    }
    public function setPackaging(string $pPackaging): self
    {
        $this->packaging = $pPackaging;
        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }
    public function setQuantity(float $pQuantity): self
    {
        $this->quantity = $pQuantity;
        return $this;
    }

    public function getNutriscore(): ?Nutriscore
    {
        return $this->nutriscore;
    }
    public function setNutriscore(?Nutriscore $pNutriscore): self
    {
        $this->nutriscore = $pNutriscore;
        return $this;
    }
    public function getCategory(): ?Category
    {
        return $this->category;
    }
    public function setCategory(?Category $pCategory): self
    {
        $this->category = $pCategory;
        return $this;
    }
}