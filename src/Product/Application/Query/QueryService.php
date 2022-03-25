<?php

namespace App\Product\Application\Query;

use App\Product\Application\DTO\Product;

interface QueryService
{
    public function getProductById(string $id): Product;
}