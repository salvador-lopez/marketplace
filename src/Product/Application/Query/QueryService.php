<?php

namespace App\Product\Application\Query;

use App\Product\Application\DTO\Product;

interface QueryService
{
    /**
     * @return Product[]
     */
    public function getAll(): array;
}