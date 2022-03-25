<?php

namespace App\Product\Application\DTO;

use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get'],
)]
final class Product
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}