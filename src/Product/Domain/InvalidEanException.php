<?php

namespace App\Product\Domain;

use JetBrains\PhpStorm\Pure;

class InvalidEanException extends \Exception
{
    #[Pure]
    public function __construct(string $value)
    {
        $this->message = "Invalid ean provided: <$value>, must follow ean-13 format";
        parent::__construct();
    }
}