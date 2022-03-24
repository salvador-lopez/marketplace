<?php

namespace App\Product\Domain;

final class Product
{
    private Ean $id;

    public function __construct(Ean $id)
    {
        $this->id = $id;
    }
}