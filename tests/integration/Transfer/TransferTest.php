<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer;

use ArrayObject;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\Attributes\WithoutErrorHandler;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorHelperTrait;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\ImBackedEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemCollectionTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\NamespaceTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ProtectedTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\RequiredTransfer;
use Picamator\TransferObject\Transfer\Exception\PropertyTypeTransferException;
use ReflectionProperty;
use TypeError;

class TransferTest extends TestCase
{
    use TransferGeneratorHelperTrait;

    private const string GENERATOR_CONFIG_PATH = __DIR__ . '/data/config/generator.config.yml';

    public static function setUpBeforeClass(): void
    {
        static::generateTransfersOrFail(self::GENERATOR_CONFIG_PATH);
    }

    /**
     * @param array<string,mixed> $data
     * @param array<string,mixed> $expected
     */
    #[DataProvider('fromToArrayDataProvider')]
    public function testFromToArrayTransformation(array $data, array $expected): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();

        // Act
        $itemCollectionTransfer->fromArray($data);
        $actual = $itemCollectionTransfer->toArray();

        // Assert
        $this->assertContainsOnlyInstancesOf(ItemTransfer::class, $itemCollectionTransfer->items);
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
                ItemCollectionTransfer::ITEM => null,
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
                    ],
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
                    ],
                ],
                ItemCollectionTransfer::ITEM => null,
            ],
        ];

        yield 'collection transfer object is empty array' => [
            [
                ItemCollectionTransfer::ITEMS => []
            ],
            [
                ItemCollectionTransfer::ITEMS => [],
                ItemCollectionTransfer::ITEM => null,
            ],
        ];
    }

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

    public function testCount(): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();
        $itemCollectionTransfer->items[] = new ItemTransfer();

        // Act
        $actual = $itemCollectionTransfer->count();

        // Assert
        $this->assertEquals(2, $actual);
        $this->assertCount(2, $itemCollectionTransfer);
    }

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

    #[WithoutErrorHandler]
    public function testTypeMismatchFromArrayShouldFailedWithError(): void
    {
        // Arrange
        $itemTransfer = new ItemTransfer();

        // Expect
        $this->expectException(TypeError::class);

        // Act
        $itemTransfer->fromArray([
            ItemTransfer::I_AM_STRING => new ArrayObject(),
        ]);
    }

    public function testAccessRequiredPropertyBeforeInitialisingShouldRiseException(): void
    {
        // Arrange
        $requiredTransfer = new RequiredTransfer();

        // Expect
        $this->expectException(TypeError::class);

        // Act
        $requiredTransfer->toArray();
    }

    /**
     * @param array<string,mixed> $data
     */
    #[TestWith([[ItemTransfer::I_AM_ARRAY => true]])]
    #[TestWith([[ItemTransfer::I_AM_ARRAY_OBJECT => true]])]
    #[TestWith([[ItemTransfer::I_AM_ENUM => true]])]
    public function testItemTransferAttributeTypeMismatchFromArrayShouldRiseException(array $data): void
    {
        // Arrange
        $itemTransfer = new ItemTransfer();

        // Expect
        $this->expectException(PropertyTypeTransferException::class);

        // Act
        $itemTransfer->fromArray($data);
    }

    /**
     * @param array<string,mixed> $data
     */
    #[TestWith([[ItemTransfer::I_AM_INT => []]])]
    public function testItemTransferPropertyTypeMismatchFromArrayShouldRiseException(array $data): void
    {
        // Arrange
        $itemTransfer = new ItemTransfer();

        // Expect
        $this->expectException(TypeError::class);

        // Act
        $itemTransfer->fromArray($data);
    }

    /**
     * @param array<string,mixed> $data
     */
    #[TestWith([[ItemCollectionTransfer::ITEMS => true]])]
    #[TestWith([[ItemCollectionTransfer::ITEM => true]])]
    #[TestWith([[ItemCollectionTransfer::ITEMS => ['some-string']]])]
    public function testItemCollectionTransferAttributeTypeMismatchFromArrayShouldRiseException(array $data): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();

        // Expect
        $this->expectException(PropertyTypeTransferException::class);

        // Act
        $itemCollectionTransfer->fromArray($data);
    }

    public function testTypeWithNamespaceShouldSucceed(): void
    {
        // Arrange
        $namespaceTransfer = new NamespaceTransfer();
        $namespaceTransfer->items[] = new ItemTransfer();
        $namespaceTransfer->required = new RequiredTransfer();

        // Act
        $this->assertCount(1, $namespaceTransfer->items);
    }

    public function testProtectedProperty(): void
    {
        // Arrange
        $reflectionProperty = new ReflectionProperty(ProtectedTransfer::class, 'iAmProtected');

        // Assert
        $this->assertTrue($reflectionProperty->isProtectedSet());
    }

    public function testClone(): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer([
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
                ],
            ],
            ItemCollectionTransfer::ITEM => [],
        ]);

        // Act
        $clonedItemCollectionTransfer = clone $itemCollectionTransfer;

        // Assert
        $this->assertNotSame($itemCollectionTransfer, $clonedItemCollectionTransfer);
        $this->assertNotSame($itemCollectionTransfer->item, $clonedItemCollectionTransfer->item);
        $this->assertNotSame($itemCollectionTransfer->items, $clonedItemCollectionTransfer->items);
        $this->assertNotSame($itemCollectionTransfer->items[0], $clonedItemCollectionTransfer->items[0]);
    }
}
