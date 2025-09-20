<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer;

use ArrayObject;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestDoxFormatter;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\Attributes\WithoutErrorHandler;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorHelperTrait;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\ImBackedEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\BcMath\BcMathNumberTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemCollectionTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\NamespaceTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ProtectedTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\RequiredTransfer;
use Picamator\TransferObject\Transfer\Exception\DataAssertTransferException;
use ReflectionProperty;
use TypeError;

#[Group('transfer')]
class TransferTest extends TestCase
{
    use TransferGeneratorHelperTrait;

    private const string GENERATOR_CONFIG_PATH = __DIR__ . '/data/config/generator.config.yml';
    private const string GENERATOR_BC_MATH_CONFIG_PATH = __DIR__ . '/data/config/bcmath/generator.config.yml';

    public static function setUpBeforeClass(): void
    {
        static::generateTransfersOrFail(self::GENERATOR_CONFIG_PATH);
    }

    /**
     * @param array<string,mixed> $data
     * @param array<string,mixed> $expected
     */
    #[DataProvider('fromToArrayDataProvider')]
    #[TestDoxFormatter('fromToArrayTestDoxFormatter')]
    public function testTransformationFromToArray(array $data, array $expected): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();

        // Act
        $itemCollectionTransfer->fromArray($data);
        $actual = $itemCollectionTransfer->toArray();

        // Assert
        // @phpstan-ignore method.alreadyNarrowedType
        $this->assertContainsOnlyInstancesOf(ItemTransfer::class, $itemCollectionTransfer->items);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @param array<string,mixed> $data
     * @param array<string,mixed> $expected
     */
    public static function fromToArrayTestDoxFormatter(array $data, array $expected): string
    {
        return sprintf(
            "Transformation fromArray \n %s \n to toArray expected \n %s",
            json_encode($data),
            json_encode($expected),
        );
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
                        ItemTransfer::I_AM_DATE_TIME => '2025-05-03T20:53:00+02:00',
                        ItemTransfer::I_AM_DATE_TIME_IMMUTABLE => '2025-05-03T20:53:00+02:00',
                    ],
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
                        ItemTransfer::I_AM_DATE_TIME => '2025-05-03T20:53:00+02:00',
                        ItemTransfer::I_AM_DATE_TIME_IMMUTABLE => '2025-05-03T20:53:00+02:00',
                    ],
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
                        ItemTransfer::I_AM_DATE_TIME => null,
                        ItemTransfer::I_AM_DATE_TIME_IMMUTABLE => null,
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
                        ItemTransfer::I_AM_DATE_TIME => null,
                        ItemTransfer::I_AM_DATE_TIME_IMMUTABLE => null,
                    ],
                ],
                ItemCollectionTransfer::ITEM => null,
            ],
        ];

        yield 'collection transfer object is empty array' => [
            [
                ItemCollectionTransfer::ITEMS => [],
            ],
            [
                ItemCollectionTransfer::ITEMS => [],
                ItemCollectionTransfer::ITEM => null,
            ],
        ];

        yield 'data does not have any matched to transfer object properties' => [
            [
                'some-property' => 'some-value',
            ],
            [
                ItemCollectionTransfer::ITEMS => [],
                ItemCollectionTransfer::ITEM => null,
            ],
        ];
    }

    #[TestDox('Transfer serialize')]
    public function testTransferSerialize(): void
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

    #[TestDox('Transfer jsonSerialize')]
    public function testTransferJsonSerialize(): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();
        $itemCollectionTransfer->items[] = new ItemTransfer();

        // Act
        $encoded = json_encode($itemCollectionTransfer, flags: JSON_THROW_ON_ERROR);
        $decoded = json_decode($encoded, true, flags: JSON_THROW_ON_ERROR);

        // Assert
        $this->assertEquals($itemCollectionTransfer->toArray(), $decoded);
    }

    #[TestDox('Transfer count')]
    public function testTransferCount(): void
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

    #[TestDox('Transfer debugInfo')]
    public function testTransferDebugInfo(): void
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
    #[TestDox('Type mismatch fromArray should fail with error')]
    public function testTypeMismatchFromArrayShouldFailWithError(): void
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

    #[TestDox('Access required property before initialising should throw exception')]
    public function testAccessRequiredPropertyBeforeInitialisingShouldThrowException(): void
    {
        // Arrange
        $requiredTransfer = new RequiredTransfer();

        // Expect
        $this->expectException(TypeError::class);

        // Act
        // @phpstan-ignore expr.resultUnused
        $requiredTransfer->iAmRequired;
    }

    /**
     * @param array<string,mixed> $data
     */
    #[TestWith([[ItemTransfer::I_AM_ARRAY => true]], 'Expecting type array but received boolean')]
    #[TestWith([[ItemTransfer::I_AM_ARRAY_OBJECT => true]], 'Expecting type ArrayObject but received boolean')]
    #[TestWith([[ItemTransfer::I_AM_ENUM => true]], 'Expecting type Enum but received boolean')]
    #[TestWith([[ItemTransfer::I_AM_DATE_TIME => true]], 'Expecting type DateTime but received boolean')]
    public function testItemTransferAttributeTypeMismatchFromArrayShouldThrowException(array $data): void
    {
        // Arrange
        $itemTransfer = new ItemTransfer();

        // Expect
        $this->expectException(DataAssertTransferException::class);

        // Act
        $itemTransfer->fromArray($data);
    }

    /**
     * @param array<string,mixed> $data
     */
    #[TestWith([[ItemTransfer::I_AM_INT => []]], 'Expecting type int, but received array')]
    public function testItemTransferPropertyTypeMismatchFromArrayShouldThrowException(array $data): void
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
    #[TestWith([[ItemCollectionTransfer::ITEMS => true]], 'Expecting type array of arrays but received boolean')]
    #[TestWith([[ItemCollectionTransfer::ITEM => true]], 'Expecting type array but received boolean')]
    // phpcs:disable Generic.Files.LineLength
    #[TestWith([[ItemCollectionTransfer::ITEMS => ['some-string']]], 'Expecting type array of arrays but received array')]
    public function testItemCollectionTransferAttributeTypeMismatchFromArrayShouldThrowException(array $data): void
    {
        // Arrange
        $itemCollectionTransfer = new ItemCollectionTransfer();

        // Expect
        $this->expectException(DataAssertTransferException::class);

        // Act
        $itemCollectionTransfer->fromArray($data);
    }

    #[TestDox('Type with namespace')]
    public function testTypeWithNamespace(): void
    {
        // Arrange
        $namespaceTransfer = new NamespaceTransfer();
        $namespaceTransfer->items[] = new ItemTransfer();
        $namespaceTransfer->required = new RequiredTransfer();

        // Act
        $this->assertCount(1, $namespaceTransfer->items);
    }

    #[TestDox('Protected property')]
    public function testProtectedProperty(): void
    {
        // Arrange
        $reflectionProperty = new ReflectionProperty(ProtectedTransfer::class, 'iAmProtected');

        // Assert
        $this->assertTrue($reflectionProperty->isProtectedSet(), 'Property is not protected for setting.');
    }

    #[TestDox('Transfer clone')]
    public function testTransferClone(): void
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

    #[RequiresPhpExtension('bcmath')]
    #[TestDox('Transformation BcMath fromArray to toArray')]
    public function testTransformationBcMathFromToArray(): void
    {
        // Arrange
        static::generateTransfersOrFail(self::GENERATOR_BC_MATH_CONFIG_PATH);

        $numberTransfer = new BcMathNumberTransfer();
        $expected = '12.123';

        // Act
        $numberTransfer->fromArray([
            BcMathNumberTransfer::I_AM_NUMBER => $expected,
        ]);

        $actual = $numberTransfer->toArray();

        // Assert
        $this->assertSame($expected, $actual[BcMathNumberTransfer::I_AM_NUMBER]);
    }
}
