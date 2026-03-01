<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Parser\Filter;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Filter\PropertyNormalizerTrait;

#[Group('transfer-generator')]
final class PropertyNormalizerTest extends TestCase
{
    private PropertyNormalizerInterface $propertyNormalizer;

    protected function setUp(): void
    {
        $this->propertyNormalizer = new class () implements PropertyNormalizerInterface {
            use PropertyNormalizerTrait {
                normalizeProperties as public;
            }
        };
    }

    public function testPropertyKeyIsIntegerShouldBeSkipped(): void
    {
        // Arrange
        $properties = [
            'someProperty' => [
                0 => 'test',
            ],
        ];

        // Act
        $actual = $this->propertyNormalizer->normalizeProperties($properties);

        // Assert
        $this->assertEmpty($actual['someProperty']);
    }

    public function testUnknowPropertyKeyShouldBeSkipped(): void
    {
        // Arrange
        $properties = [
            'someProperty' => [
                'unknownKey' => 'test',
            ],
        ];

        // Act
        $actual = $this->propertyNormalizer->normalizeProperties($properties);

        // Assert
        $this->assertEmpty($actual['someProperty']);
    }
}
