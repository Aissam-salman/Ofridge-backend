<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product\Product as Product;
use App\Entity\Product\Keyword as Keyword;


#[ORM\Entity]
#[ORM\Table(name: "product_keyword")]
class ProductKeyword {
    #[ORM\Id]
    #[ORM\ManyToMany()]
}