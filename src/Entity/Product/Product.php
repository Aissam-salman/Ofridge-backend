<?php

namespace App\Entity\Product;

use Doctrine\DBAL\Types\BlobType;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product\Nutriscore as Nutriscore;
use App\Entity\Product\Category as Category;
use App\Entity\Product\Country as Country;
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

    #[ORM\Column(name:"product_img_front",type: "blob", nullable: false)]
    private BlobType $imgFront;

    #[ORM\Column(name:"product_packaging", type: "string")]
    private string $packaging;

    #[ORM\Column(name:"product_quantity", type: "float")]
    private float $quantity;

    #[ORM\ManyToOne(targetEntity: Nutriscore::class, fetch: "LAZY")]
    #[ORM\JoinColumn(name: "nutriscore_id", referencedColumnName: "nutriscore_id")]
    private Nutriscore $nutriscore;


    #[ORM\JoinTable(name: "product_category")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"category_id", referencedColumnName: "category_id")]
    #[ORM\ManyToMany(targetEntity: Category::class, fetch: "LAZY")]
    private ArrayCollection|Category $category;

    #[ORM\JoinTable(name: "location")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"country_id", referencedColumnName: "country_id")]
    #[ORM\ManyToMany(targetEntity: Country::class, fetch: "LAZY")]
    private ArrayCollection|Country $countries;


    #[ORM\JoinTable(name: "product_keyword")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"keyword_id", referencedColumnName: "keyword_id")]
    #[ORM\ManyToMany(targetEntity: keyword::class, fetch: "LAZY")]
    private ArrayCollection|Keyword $keywords;

    #[ORM\JoinTable(name: "product_nutriment")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"nutriment_id", referencedColumnName: "nutriment_id")]
    #[ORM\ManyToMany(targetEntity: Nutriment::class, fetch: "LAZY")]
    private ArrayCollection|Nutriment $nutriments;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: "composition")]
    private Collection $myComposer;

    #[ORM\JoinTable(name: "product_composition")]
    #[ORM\JoinColumn(name: "product_code", referencedColumnName: "product_code")]
    #[ORM\InverseJoinColumn(name:"product_code_1", referencedColumnName: "product_code")]
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: "myComposer", fetch: "LAZY")]
    private ArrayCollection|Product $composition;

    #[ORM\Column(name: "product_created_at", type: "datetime", nullable: false)]
    private \DateTimeInterface $createdAt;
    #[ORM\Column(name: "product_updated_at", type: "datetime", nullable: false)]
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

    public function getCountries(): ArrayCollection|Country
    {
        return $this->countries;
    }
    public function setCountries(ArrayCollection|Country $pCountries): self
    {
        $this->countries = $pCountries;
        return $this;
    }
    public function getKeywords(): ArrayCollection|Keyword
    {
        return $this->keywords;
    }
    public function setKeywords(ArrayCollection|Keyword $pKeywords): self
    {
        $this->keywords = $pKeywords;
        return $this;
    }
    public function getNutriments(): ArrayCollection|Nutriment
    {
        return $this->nutriments;
    }
    public function setNutriments(ArrayCollection|Nutriment $pNutriments): self
    {
        $this->nutriments = $pNutriments;
        return $this;
    }
    public function getComposition(): ArrayCollection|Product
    {
        return $this->composition;
    }
    public function setComposition(ArrayCollection|Product $pComposition): self
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