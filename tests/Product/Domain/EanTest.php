<?php

namespace Product\Domain;

use App\Product\Domain\Ean;
use App\Product\Domain\InvalidEanException;
use Faker\Factory;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;

class EanTest extends TestCase
{
    /**
     * @test
     * @throws InvalidEanException
     */
    public function shouldCreateEAN(): void
    {
        $eanValue = Factory::create()->ean13();

        $ean = new Ean($eanValue);

        $this->assertSame($eanValue, $ean->getValue());
    }

    /**
     * @test
     *
     * @dataProvider getEANInvalidDataProvider
     */
    public function shouldThrowInvalidEANExceptionWhenIsInvalid(string $eanValueInvalid): void
    {
        $this->expectException(InvalidEanException::class);
        $this->expectExceptionMessage("Invalid ean provided: <$eanValueInvalid>, must follow ean-13 format");

        new Ean($eanValueInvalid);
    }

    #[ArrayShape(['Less than 13 digits' => "string[]", 'More than 13 digits' => "string[]", 'Include letter' => "string[]"])]
    public function getEANInvalidDataProvider(): array
    {
        return [
            'Less than 13 digits' =>  ['123'],
            'More than 13 digits' => ['123'],
            'Include letter' => ['123456789876r'],
        ];
    }
}
