<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product\Nutriscore as Nutriscore;
use App\Entity\Product\Category as Category;
use App\Entity\Product\Country as Country;
use App\Entity\Product\Keyword as Keyword;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'product')]
class Product {
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"IDENTITY")]
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

    #[ORM\Column(name:"product_img_front",type: "string", nullable: false)]
    private string $imgFront;

    #[ORM\Column(name:"product_packaging", type: "string")]
    private string $packaging;

    #[ORM\Column(name:"product_quantity", type: "float")]
    private float $quantity;

    #[ORM\ManyToOne(targetEntity: Nutriscore::class, fetch: "LAZY")]
    #[ORM\JoinColumn(name: "fk_nutriscore_id", referencedColumnName: "nutriscore_id")]
    private ?Nutriscore $nutriscore;


    #[ORM\JoinTable(name: "product_category")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"category_id", referencedColumnName: "category_id")]
    #[ORM\ManyToMany(targetEntity: Category::class, fetch: "LAZY")]
    private string $category;

    #[ORM\JoinTable(name: "location")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"country_id", referencedColumnName: "country_id")]
    #[ORM\ManyToMany(targetEntity: Country::class, fetch: "LAZY")]
    private string $countries;


    #[ORM\JoinTable(name: "product_keyword")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"keyword_id", referencedColumnName: "keyword_id")]
    #[ORM\ManyToMany(targetEntity: Keyword::class, fetch: "LAZY")]
    private string $keywords;

    #[ORM\JoinTable(name: "product_nutriment")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"nutriment_id", referencedColumnName: "nutriment_id")]
    #[ORM\ManyToMany(targetEntity: Nutriment::class, fetch: "LAZY")]
    private string $nutriments;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: "composition")]
    private string $myComposer;

    #[ORM\JoinTable(name: "product_composition")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"product_code_1", referencedColumnName: "product_code")]
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: "myComposer", fetch: "LAZY")]
    private string $composition;

    #[ORM\Column(name: "product_created_at", type: "datetime")]
    private \DateTimeInterface $createdAt;
    #[ORM\Column(name: "product_updated_at", type: "datetime")]
    private \DateTimeInterface $updatedAt;


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

    public function getImgFront(): ?string
    {
        return $this->imgFront;
    }
    public function setImgFront(string $pImgFront): self
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

    public function getNutriscore(): ?string
    {
        return $this->nutriscore ?? '';
    }
    public function setNutriscore(?Nutriscore $pNutriscore): self
    {
        $this->nutriscore = $pNutriscore;
        return $this;
    }
    public function getCategory(): ?string
    {
        return $this->category;
    }
    public function setCategory(?string $pCategory): self
    {
        $this->category = $pCategory;
        return $this;
    }

    public function getCountries(): ?string
    {
        return $this->countries;
    }
    public function setCountries(?string $pCountries): self
    {
        $this->countries = $pCountries;
        return $this;
    }
    public function getKeywords(): string
    {
        return $this->keywords;
    }
    public function setKeywords(string $pKeywords): self
    {
        $this->keywords = $pKeywords;
        return $this;
    }
    public function getNutriments(): string
    {
        return $this->nutriments;
    }
    public function setNutriments(string $pNutriments): self
    {
        $this->nutriments = $pNutriments;
        return $this;
    }
    public function getComposition(): string
    {
        return $this->composition;
    }
    public function setComposition(string $pComposition): self
    {
        $this->composition = $pComposition;
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