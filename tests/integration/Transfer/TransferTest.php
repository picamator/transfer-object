<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorHelperTrait;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\ImBackedEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\ImBasicEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemCollectionTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemTransfer;

class TransferTest extends TestCase
{
    use TransferGeneratorHelperTrait;

    private const string GENERATOR_CONFIG_PATH = __DIR__ . '/data/config/generator.config.yml';

    public function testGenerateTransferShouldSucceed(): void
    {
        // Arrange
        $this->assertLoadConfigSuccess(self::GENERATOR_CONFIG_PATH);

        // Act
        $actual = $this->generateTransfers($this->assertGeneratorSuccess(...));

        // Assert
        $this->assertTrue($actual);
    }

    /**
     * @param array<string,mixed> $data
     * @param array<string,mixed> $expected
     */
    #[DataProvider('fromToArrayDataProvider')]
    #[Depends('testGenerateTransferShouldSucceed')]
    public function testFromToArrayTransformation(array $data, array $expected): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();

        // Act
        $itemCollectionTransfer->fromArray($data);
        $actual = $itemCollectionTransfer->toArray();

        // Assert
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function fromToArrayDataProvider(): Generator
    {
        yield 'all transfer object properties are set' => [
            [
                ItemCollectionTransfer::ITEMS => [
                    [
                        ItemTransfer::I_AM_BOOL => true,
                        ItemTransfer::I_AM_TRUE => true,
                        ItemTransfer::I_AM_FALSE => false,
                        ItemTransfer::I_AM_INT => 1,
                        ItemTransfer::I_AM_FLOAT => 0.1,
                        ItemTransfer::I_AM_STRING => 'test string',
                        ItemTransfer::I_AM_ARRAY => ['key' => 'value'],
                        ItemTransfer::I_AM_ARRAY_OBJECT => ['key' => 'value'],
                        ItemTransfer::I_AM_ENUM => ImBackedEnum::SOME_CASE->value,
                    ]
                ],
            ],
            [
                ItemCollectionTransfer::ITEMS => [
                    [
                        ItemTransfer::I_AM_BOOL => true,
                        ItemTransfer::I_AM_TRUE => true,
                        ItemTransfer::I_AM_FALSE => false,
                        ItemTransfer::I_AM_INT => 1,
                        ItemTransfer::I_AM_FLOAT => 0.1,
                        ItemTransfer::I_AM_STRING => 'test string',
                        ItemTransfer::I_AM_ARRAY => ['key' => 'value'],
                        ItemTransfer::I_AM_ARRAY_OBJECT => ['key' => 'value'],
                        ItemTransfer::I_AM_ENUM => ImBackedEnum::SOME_CASE->value,
                    ]
                ],
            ],
        ];

        yield 'all transfer object properties are set backed enum has basic enum should resolve as null' => [
            [
                ItemCollectionTransfer::ITEMS => [
                    [
                        ItemTransfer::I_AM_BOOL => true,
                        ItemTransfer::I_AM_TRUE => true,
                        ItemTransfer::I_AM_FALSE => false,
                        ItemTransfer::I_AM_INT => 1,
                        ItemTransfer::I_AM_FLOAT => 0.1,
                        ItemTransfer::I_AM_STRING => 'test string',
                        ItemTransfer::I_AM_ARRAY => ['key' => 'value'],
                        ItemTransfer::I_AM_ARRAY_OBJECT => ['key' => 'value'],
                        ItemTransfer::I_AM_ENUM => ImBasicEnum::SOMETHING,
                    ]
                ],
            ],
            [
                ItemCollectionTransfer::ITEMS => [
                    [
                        ItemTransfer::I_AM_BOOL => true,
                        ItemTransfer::I_AM_TRUE => true,
                        ItemTransfer::I_AM_FALSE => false,
                        ItemTransfer::I_AM_INT => 1,
                        ItemTransfer::I_AM_FLOAT => 0.1,
                        ItemTransfer::I_AM_STRING => 'test string',
                        ItemTransfer::I_AM_ARRAY => ['key' => 'value'],
                        ItemTransfer::I_AM_ARRAY_OBJECT => ['key' => 'value'],
                        ItemTransfer::I_AM_ENUM => null,
                    ]
                ],
            ],
        ];

        yield 'all transfer object properties are null should resolve array, array object and enum' => [
            [
                ItemCollectionTransfer::ITEMS => [
                    [
                        ItemTransfer::I_AM_BOOL => null,
                        ItemTransfer::I_AM_TRUE => null,
                        ItemTransfer::I_AM_FALSE => null,
                        ItemTransfer::I_AM_INT => null,
                        ItemTransfer::I_AM_FLOAT => null,
                        ItemTransfer::I_AM_STRING => null,
                        ItemTransfer::I_AM_ARRAY => null,
                        ItemTransfer::I_AM_ARRAY_OBJECT => null,
                        ItemTransfer::I_AM_ENUM => null,
                    ]
                ],
            ],
            [
                ItemCollectionTransfer::ITEMS => [
                    [
                        ItemTransfer::I_AM_BOOL => null,
                        ItemTransfer::I_AM_TRUE => null,
                        ItemTransfer::I_AM_FALSE => null,
                        ItemTransfer::I_AM_INT => null,
                        ItemTransfer::I_AM_FLOAT => null,
                        ItemTransfer::I_AM_STRING => null,
                        ItemTransfer::I_AM_ARRAY => [],
                        ItemTransfer::I_AM_ARRAY_OBJECT => [],
                        ItemTransfer::I_AM_ENUM => null,
                    ]
                ],
            ],
        ];

        yield 'collection transfer object is empty array' => [
            [
                ItemCollectionTransfer::ITEMS => []
            ],
            [
                ItemCollectionTransfer::ITEMS => [],
            ],
        ];
    }

    #[Depends('testGenerateTransferShouldSucceed')]
    public function testSerialize(): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();
        $itemCollectionTransfer->items[] = new ItemTransfer();

        // Act
        $serialized = serialize($itemCollectionTransfer);
        $unserialized = unserialize($serialized);

        // Assert
        $this->assertInstanceOf(ItemCollectionTransfer::class, $unserialized);
        $this->assertEquals($itemCollectionTransfer->toArray(), $unserialized->toArray());
    }

    #[Depends('testGenerateTransferShouldSucceed')]
    public function testJsonSerialize(): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();
        $itemCollectionTransfer->items[] = new ItemTransfer();

        // Act
        $encoded = json_encode($itemCollectionTransfer, flags:JSON_THROW_ON_ERROR);
        $decoded = json_decode($encoded, true, flags:JSON_THROW_ON_ERROR);

        // Assert
        $this->assertEquals($itemCollectionTransfer->toArray(), $decoded);
    }

    #[Depends('testGenerateTransferShouldSucceed')]
    public function testCount(): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();
        $itemCollectionTransfer->items[] = new ItemTransfer();

        // Act
        $actual = $itemCollectionTransfer->count();

        // Assert
        $this->assertEquals(1, $actual);
        $this->assertCount(1, $itemCollectionTransfer);
    }

    #[Depends('testGenerateTransferShouldSucceed')]
    public function testDebugInfo(): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();
        $itemCollectionTransfer->items[] = new ItemTransfer();

        // Act
        $actual = $itemCollectionTransfer->__debugInfo();

        // Assert
        $this->assertEquals($itemCollectionTransfer->toArray(), $actual);
    }
}
