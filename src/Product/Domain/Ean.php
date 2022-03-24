<?php

namespace App\Product\Domain;

class Ean
{
    private string $value;

    /**
     * @throws InvalidEanException
     */
    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    /**
     * @throws InvalidEanException
     */
    private function setValue(string $value): void
    {
        if (!preg_match("/^[0-9]{13}$/", $value)) {
            throw new InvalidEanException($value);
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}