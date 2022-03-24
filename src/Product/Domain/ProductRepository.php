<?php

namespace App\Product\Domain;

interface ProductRepository
{
    public function save(Product $product): void;
}