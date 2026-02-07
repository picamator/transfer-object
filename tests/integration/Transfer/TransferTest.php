<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer;

use ArrayObject;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestDoxFormatter;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\Attributes\WithoutErrorHandler;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorTrait;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\CountryEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\ImBackedEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\YesNoEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\BcMath\BcMathNumberTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\EnumTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemCollectionTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\NamespaceTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ProtectedTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\RequiredTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ReservedConstantTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\SymfonyAttributeTransfer;
use Picamator\TransferObject\Transfer\Exception\DataAssertTransferException;
use ReflectionProperty;
use Symfony\Component\Validator\Validation;
use TypeError;

#[Group('transfer')]
class TransferTest extends TestCase
{
    use TransferGeneratorTrait;

    private const string GENERATOR_CONFIG_PATH = __DIR__ . '/data/config/generator.config.yml';
    private const string GENERATOR_BC_MATH_CONFIG_PATH = __DIR__ . '/data/config/bcmath/generator.config.yml';

    public static function setUpBeforeClass(): void
    {
        static::generateTransfersOrFail(self::GENERATOR_CONFIG_PATH);
    }

    /**
     * @param array<string, mixed>|null $data
     */
    #[TestWith([null], 'Create transfer without data')]
    #[TestWith([[]], 'Create transfer with empty array data')]
    #[TestWith([[null]], 'Create transfer with array data containing null')]
    #[TestWith([['something' => 'unknown']], 'Create transfer with array data containing unknown property')]
    public function testCreateTransfer(?array $data): void
    {
        // Act
        $itemTransfer = new ItemTransfer($data);

        // Assert
        $this->assertNull($itemTransfer->iAmBool);
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
                ItemCollectionTransfer::ITEMS_PROP => [
                    [
                        ItemTransfer::I_AM_BOOL_PROP => true,
                        ItemTransfer::I_AM_TRUE_PROP => true,
                        ItemTransfer::I_AM_FALSE_PROP => false,
                        ItemTransfer::I_AM_INT_PROP => 1,
                        ItemTransfer::I_AM_FLOAT_PROP => 0.1,
                        ItemTransfer::I_AM_STRING_PROP => 'test string',
                        ItemTransfer::I_AM_ARRAY_PROP => ['key' => 'value'],
                        ItemTransfer::I_AM_ARRAY_WITH_DOC_BLOCK_PROP => ['value'],
                        ItemTransfer::I_AM_ARRAY_OBJECT_PROP => ['key' => 'value'],
                        ItemTransfer::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP => ['value'],
                        ItemTransfer::I_AM_ENUM_PROP => ImBackedEnum::SOME_CASE->value,
                        ItemTransfer::I_AM_DATE_TIME_PROP => '2025-05-03T20:53:00+02:00',
                        ItemTransfer::I_AM_DATE_TIME_IMMUTABLE_PROP => '2025-05-03T20:53:00+02:00',
                        ItemTransfer::I_AM_WITH_ATTRIBUTE_PROP => ['value'],
                    ],
                ],
            ],
            [
                ItemCollectionTransfer::ITEMS_PROP => [
                    [
                        ItemTransfer::I_AM_BOOL_PROP => true,
                        ItemTransfer::I_AM_TRUE_PROP => true,
                        ItemTransfer::I_AM_FALSE_PROP => false,
                        ItemTransfer::I_AM_INT_PROP => 1,
                        ItemTransfer::I_AM_FLOAT_PROP => 0.1,
                        ItemTransfer::I_AM_STRING_PROP => 'test string',
                        ItemTransfer::I_AM_ARRAY_PROP => ['key' => 'value'],
                        ItemTransfer::I_AM_ARRAY_WITH_DOC_BLOCK_PROP => ['value'],
                        ItemTransfer::I_AM_ARRAY_OBJECT_PROP => ['key' => 'value'],
                        ItemTransfer::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP => ['value'],
                        ItemTransfer::I_AM_ENUM_PROP => ImBackedEnum::SOME_CASE->value,
                        ItemTransfer::I_AM_DATE_TIME_PROP => '2025-05-03T20:53:00+02:00',
                        ItemTransfer::I_AM_DATE_TIME_IMMUTABLE_PROP => '2025-05-03T20:53:00+02:00',
                        ItemTransfer::I_AM_WITH_ATTRIBUTE_PROP => ['value'],
                    ],
                ],
                ItemCollectionTransfer::ITEM_PROP => null,
            ],
        ];

        yield 'all transfer object properties are null should resolve array, array object and enum' => [
            [
                ItemCollectionTransfer::ITEMS_PROP => [
                    [
                        ItemTransfer::I_AM_BOOL_PROP => null,
                        ItemTransfer::I_AM_TRUE_PROP => null,
                        ItemTransfer::I_AM_FALSE_PROP => null,
                        ItemTransfer::I_AM_INT_PROP => null,
                        ItemTransfer::I_AM_FLOAT_PROP => null,
                        ItemTransfer::I_AM_STRING_PROP => null,
                        ItemTransfer::I_AM_ARRAY_PROP => null,
                        ItemTransfer::I_AM_ARRAY_WITH_DOC_BLOCK_PROP => null,
                        ItemTransfer::I_AM_ARRAY_OBJECT_PROP => null,
                        ItemTransfer::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP => null,
                        ItemTransfer::I_AM_ENUM_PROP => null,
                        ItemTransfer::I_AM_DATE_TIME_PROP => null,
                        ItemTransfer::I_AM_DATE_TIME_IMMUTABLE_PROP => null,
                        ItemTransfer::I_AM_WITH_ATTRIBUTE_PROP => null,
                    ],
                ],
            ],
            [
                ItemCollectionTransfer::ITEMS_PROP => [
                    [
                        ItemTransfer::I_AM_BOOL_PROP => null,
                        ItemTransfer::I_AM_TRUE_PROP => null,
                        ItemTransfer::I_AM_FALSE_PROP => null,
                        ItemTransfer::I_AM_INT_PROP => null,
                        ItemTransfer::I_AM_FLOAT_PROP => null,
                        ItemTransfer::I_AM_STRING_PROP => null,
                        ItemTransfer::I_AM_ARRAY_PROP => [],
                        ItemTransfer::I_AM_ARRAY_WITH_DOC_BLOCK_PROP => [],
                        ItemTransfer::I_AM_ARRAY_OBJECT_PROP => [],
                        ItemTransfer::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP => [],
                        ItemTransfer::I_AM_ENUM_PROP => null,
                        ItemTransfer::I_AM_DATE_TIME_PROP => null,
                        ItemTransfer::I_AM_DATE_TIME_IMMUTABLE_PROP => null,
                        ItemTransfer::I_AM_WITH_ATTRIBUTE_PROP => [],
                    ],
                ],
                ItemCollectionTransfer::ITEM_PROP => null,
            ],
        ];

        yield 'collection transfer object is empty array' => [
            [
                ItemCollectionTransfer::ITEMS_PROP => [],
            ],
            [
                ItemCollectionTransfer::ITEMS_PROP => [],
                ItemCollectionTransfer::ITEM_PROP => null,
            ],
        ];

        yield 'collection transfer object is an array with one null item' => [
            [
                ItemCollectionTransfer::ITEMS_PROP => [null],
            ],
            [
                ItemCollectionTransfer::ITEMS_PROP => [],
                ItemCollectionTransfer::ITEM_PROP => null,
            ],
        ];

        yield 'data does not have any matched to transfer object properties' => [
            [
                'some-property' => 'some-value',
            ],
            [
                ItemCollectionTransfer::ITEMS_PROP => [],
                ItemCollectionTransfer::ITEM_PROP => null,
            ],
        ];
    }

    /**
     * @param array<string,mixed> $data
     * @param array<string,mixed> $expected
     */
    #[TestDoxFormatter('fromToArrayTestDoxFormatter')]
    #[TestWith([
        [
            ItemTransfer::I_AM_DATE_TIME_PROP => 1759419659,
            ItemTransfer::I_AM_DATE_TIME_IMMUTABLE_PROP => 1759419659,
        ], [
            ItemTransfer::I_AM_DATE_TIME_PROP => '2025-10-02T15:40:59+00:00',
            ItemTransfer::I_AM_DATE_TIME_IMMUTABLE_PROP => '2025-10-02T15:40:59+00:00',
        ],
    ], 'Date and date time immutable are integer timestamp')]
    #[TestWith([
        [
            ItemTransfer::I_AM_DATE_TIME_PROP => 1759419693.3584,
            ItemTransfer::I_AM_DATE_TIME_IMMUTABLE_PROP => 1759419693.3584,
        ], [
            ItemTransfer::I_AM_DATE_TIME_PROP => '2025-10-02T15:41:33+00:00',
            ItemTransfer::I_AM_DATE_TIME_IMMUTABLE_PROP => '2025-10-02T15:41:33+00:00',
        ],
    ], 'Date and date time immutable are float microtime')]
    public function testDateTimeTransformationFromToArray(array $data, array $expected): void
    {
        // Arrange
        $itemTransfer = new ItemTransfer();

        // Act
        $itemTransfer->fromArray($data);

        $actual = $itemTransfer->toArray();
        $actual = array_filter($actual);

        // Assert
        $this->assertSame($expected, $actual);
    }

    #[TestDox('Enum transformation from and to array')]
    public function testEnumTransformationFromToArray(): void
    {
        // Arrange
        $expected = [
            EnumTransfer::COUNTRY_PROP => CountryEnum::PL->value,
            EnumTransfer::IS_ACTIVE_PROP => YesNoEnum::YES->value,
        ];

        $enumTransfer = new EnumTransfer($expected);

        // Act
        $actual = $enumTransfer->toArray();

        // Assert
        $this->assertSame($expected, $actual);
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
            ItemTransfer::I_AM_STRING_PROP => new ArrayObject(),
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
    #[TestWith([[ItemTransfer::I_AM_ARRAY_OBJECT_PROP => true]], 'Expecting type ArrayObject but received boolean')]
    #[TestWith([[ItemTransfer::I_AM_ENUM_PROP => true]], 'Expecting type Enum but received boolean')]
    #[TestWith([[ItemTransfer::I_AM_DATE_TIME_PROP => true]], 'Expecting type DateTime but received boolean')]
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
    #[TestWith([[ItemTransfer::I_AM_INT_PROP => []]], 'Expecting type int, but received array')]
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
    #[TestWith([[ItemCollectionTransfer::ITEMS_PROP => true]], 'Expecting type array of arrays but received boolean')]
    #[TestWith([[ItemCollectionTransfer::ITEM_PROP => true]], 'Expecting type array but received boolean')]
    // phpcs:disable Generic.Files.LineLength
    #[TestWith([[ItemCollectionTransfer::ITEMS_PROP => ['some-string']]], 'Expecting type array of arrays but received array')]
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
        $namespaceTransfer->itemsWithAlias[] = new ItemTransfer();

        $namespaceTransfer->required = new RequiredTransfer();
        $namespaceTransfer->requiredWithAlias = new RequiredTransfer();

        // Act
        $this->assertCount(1, $namespaceTransfer->items);
        $this->assertCount(1, $namespaceTransfer->itemsWithAlias);
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
            ItemCollectionTransfer::ITEMS_PROP => [
                [
                    ItemTransfer::I_AM_BOOL_PROP => true,
                    ItemTransfer::I_AM_TRUE_PROP => true,
                    ItemTransfer::I_AM_FALSE_PROP => false,
                    ItemTransfer::I_AM_INT_PROP => 1,
                    ItemTransfer::I_AM_FLOAT_PROP => 0.1,
                    ItemTransfer::I_AM_STRING_PROP => 'test string',
                    ItemTransfer::I_AM_ARRAY_PROP => ['key' => 'value'],
                    ItemTransfer::I_AM_ARRAY_OBJECT_PROP => ['key' => 'value'],
                    ItemTransfer::I_AM_ENUM_PROP => ImBackedEnum::SOME_CASE->value,
                ],
            ],
            ItemCollectionTransfer::ITEM_PROP => [],
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
    #[TestDox('Generate transfer object BcMath')]
    public function testGenerateBcMathTransfer(): void
    {
        // Arrange
        static::generateTransfersOrFail(self::GENERATOR_BC_MATH_CONFIG_PATH);

        // Act
        $numberTransfer = new BcMathNumberTransfer();

        // Assert
        $this->assertNull($numberTransfer->iAmNumber);
    }

    #[RequiresPhpExtension('bcmath')]
    #[Depends('testGenerateBcMathTransfer')]
    #[TestDox('Transformation transfer object BcMath fromArray with $number to toArray expecting $number')]
    #[TestWith(['12.123', '12.123'], 'Transformation from string to BcMath')]
    #[TestWith([12, '12'], 'Transformation from integer to BcMath')]
    #[TestWith([12.123, '12.123'], 'Transformation from float to BcMath')]
    public function testTransformationBcMathFromToArray(string|int|float $number, string $expected): void
    {
        // Arrange
        $numberTransfer = new BcMathNumberTransfer();

        // Act
        $numberTransfer->fromArray([
            BcMathNumberTransfer::I_AM_NUMBER_PROP => $number,
        ]);

        $actual = $numberTransfer->toArray();

        // Assert
        $this->assertSame($expected, $actual[BcMathNumberTransfer::I_AM_NUMBER_PROP]);
    }

    #[RequiresPhpExtension('bcmath')]
    #[Depends('testGenerateBcMathTransfer')]
    #[TestDox('Transformation transfer object BcMath fromArray with invalid type should throw exception')]
    public function testTransformationBcMathFromToArrayWithInvalidTypeShouldThrowException(): void
    {
        // Arrange
        $numberTransfer = new BcMathNumberTransfer();

        // Expect
        $this->expectException(DataAssertTransferException::class);

        // Act
        $numberTransfer->fromArray([
            BcMathNumberTransfer::I_AM_NUMBER_PROP => new ArrayObject(),
        ]);
    }

    #[RequiresPhpExtension('bcmath')]
    #[Depends('testGenerateBcMathTransfer')]
    #[TestDox('Transformation transfer object BcMath fromArray to toArray with BcMath')]
    public function testTransformationBcMathFromToArrayWhereArrayHasBcMath(): void
    {
        // Arrange
        $numberTransfer = new BcMathNumberTransfer();

        $expected = '12.123';
        $number = new \BcMath\Number($expected);

        // Act
        $numberTransfer->fromArray([
            BcMathNumberTransfer::I_AM_NUMBER_PROP => $number,
        ]);

        $actual = $numberTransfer->toArray();

        // Assert
        $this->assertSame($expected, $actual[BcMathNumberTransfer::I_AM_NUMBER_PROP]);
    }

    #[TestDox('Symfony assert attribute')]
    public function testSymfonyAssertAttribute(): void
    {
        // Arrange
        $symfonyAttributeTransfer = new SymfonyAttributeTransfer();

        $validator = Validation::createValidatorBuilder()
            ->enableAttributeMapping()
            ->getValidator();

        // Act
        $actual = $validator->validate($symfonyAttributeTransfer);

        // Assert
        $this->assertCount(1, $actual, 'Expected one error message');
        $this->assertSame('This value should not be blank.', $actual[0]?->getMessage());
    }

    #[TestDox('Reserved constant should not collide with transfer')]
    public function testReservedConstantShouldNotCollideWithTransfer(): void
    {
        // Act
        $reservedConstantTransfer = new ReservedConstantTransfer([
            ReservedConstantTransfer::FILTER_DATA_CALLBACK_PROP => 'filter',
            ReservedConstantTransfer::META_DATA_PROP => 'data',
            ReservedConstantTransfer::META_DATA_SIZE_PROP => '0',
        ]);

        // Assert
        $this->assertInstanceOf(ReservedConstantTransfer::class, $reservedConstantTransfer);
    }
}
