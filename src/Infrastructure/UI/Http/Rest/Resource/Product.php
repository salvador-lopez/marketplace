<?php

namespace App\Infrastructure\UI\Http\Rest\Resource;

use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get'],
)]

class Product
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }


}