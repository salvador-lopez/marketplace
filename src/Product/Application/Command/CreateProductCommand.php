<?php

namespace App\Product\Application\Command;

final class CreateProductCommand
{
    private string $eanValue;

    public function __construct(string $eanValue)
    {
        $this->eanValue = $eanValue;
    }

    public function getEanValue(): string
    {
        return $this->eanValue;
    }
}