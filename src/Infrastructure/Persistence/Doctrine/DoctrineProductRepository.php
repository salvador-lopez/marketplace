<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Product\Domain\Product;
use App\Product\Domain\ProductRepository;

class DoctrineProductRepository implements ProductRepository
{
    public function save(Product $product): void
    {
        // TODO: Implement save() method.
    }
}