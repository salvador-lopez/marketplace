<?php

namespace App\Product\Application\Command;

use App\Product\Application\DTO\Product;

final class CreateProductCommand
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}