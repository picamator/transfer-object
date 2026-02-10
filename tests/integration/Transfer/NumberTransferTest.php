<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer;

use ArrayObject;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorTrait;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\BcMath\BcMathNumberTransfer;
use Picamator\TransferObject\Transfer\Exception\DataAssertTransferException;

#[Group('transfer')]
#[RequiresPhpExtension('bcmath')]
final class NumberTransferTest extends TestCase
{
    use TransferGeneratorTrait;

    private const string GENERATOR_CONFIG_PATH = __DIR__ . '/data/config/bcmath/generator.config.yml';

    public static function setUpBeforeClass(): void
    {
        static::generateTransfersOrFail(self::GENERATOR_CONFIG_PATH);
    }

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

    #[TestDox('Transformation transfer object fromArray() and toArray() with BcMath')]
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
}
