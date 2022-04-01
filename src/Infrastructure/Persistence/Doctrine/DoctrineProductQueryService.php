<?php

namespace App\Infrastructure\Persistence\Doctrine;

use App\Product\Application\DTO\Product;
use App\Product\Application\Query\QueryService;

class DoctrineProductQueryService implements QueryService
{
    public function getAll(): array
    {
        return [
            new Product('1234567898765'),
            new Product('9876543212345'),
        ];
    }
}