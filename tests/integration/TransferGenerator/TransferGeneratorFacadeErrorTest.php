<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorTrait;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;

#[Group('transfer-generator')]
class TransferGeneratorFacadeErrorTest extends TestCase
{
    use TransferGeneratorTrait;

    private const string CONFIG_PATH_TEMPLATE = __DIR__ . '/data/config/error/%s/generator.config.yml';

    #[DataProvider('invalidDefinitionDataProvider')]
    // phpcs:disable Generic.Files.LineLength
    #[TestDox('Generate transfer objects by invalid definition "$configCaseName" should fail with message "$expectedMessage"')]
    public function testGenerateTransferObjectsByInvalidDefinitionShouldFail(
        string $configCaseName,
        string $expectedMessage,
    ): void {
        // Arrange
        $configPath = $this->getConfigPath($configCaseName);

        $callback = function (TransferGeneratorTransfer $generatorTransfer) use ($expectedMessage): void {
            if ($generatorTransfer->validator->isValid) {
                return;
            }

            $errorMessage = $generatorTransfer->validator->errorMessages[0] ?? null;

            $this->assertFalse($generatorTransfer->validator->isValid);
            $this->assertNotNull($errorMessage);
            $this->assertStringContainsString(
                $expectedMessage,
                $errorMessage->errorMessage,
            );
        };

        // Act
        $actual = $this->generateTransfersCallback($configPath, $callback);

        // Assert
        $this->assertFalse($actual, 'The validator should fail.');
    }

    #[TestDox('Generate transfer objects by duplicate definitions should fail')]
    public function testGenerateTransferObjectByDuplicateDefinitionsShouldFail(): void
    {
        $configCaseName = 'duplicate-transfer';

        // Arrange
        $configPath = $this->getConfigPath($configCaseName);

        $callback = function (TransferGeneratorTransfer $generatorTransfer): void {
            if ($generatorTransfer->validator->isValid) {
                return;
            }

            $errorMessage = $generatorTransfer->validator->errorMessages[0] ?? null;

            $this->assertFalse($generatorTransfer->validator->isValid, 'The validator should fail.');
            $this->assertNotNull($errorMessage);
            $this->assertStringContainsString(
                'A file with the same name already exists.',
                $errorMessage->errorMessage,
            );
        };

        // Act
        $actual = $this->generateTransfersCallback($configPath, $callback);

        // Assert
        $this->assertFalse($actual);
    }

    /**
     * @return Generator<string,array<string,string>>
     */
    public static function invalidDefinitionDataProvider(): Generator
    {
        yield 'invalid class name should return error' => [
            'configCaseName' => 'invalid-class-name',
            'expectedMessage' => 'Invalid class name',
        ];

        yield 'reserved property name should return error' => [
            'configCaseName' => 'reserved-property-name',
            'expectedMessage' => 'Reserved property name',
        ];

        yield 'invalid property name should return error' => [
            'configCaseName' => 'invalid-property-name',
            'expectedMessage' => 'Invalid property name',
        ];

        yield 'invalid collection type should return error' => [
            'configCaseName' => 'invalid-collection-type',
            'expectedMessage' => 'Invalid class name',
        ];

        yield 'invalid transfer type should return error' => [
            'configCaseName' => 'invalid-transfer-type',
            'expectedMessage' => 'Invalid class name',
        ];

        yield 'missing property type should return error' => [
            'configCaseName' => 'missed-type',
            'expectedMessage' => 'Property "addressUuid" type definition is missing or set multiple times.',
        ];

        yield 'unsupported type should return error' => [
            'configCaseName' => 'unsupported-type',
            'expectedMessage' => 'Property "addressBookUuid" with type "object" is not supported.',
        ];

        yield 'property type defined with array yml structure should fail to recognize type and return error' => [
            'configCaseName' => 'invalid-type-definition',
            'expectedMessage' => 'Property "addressBookUuid" type definition is missing or set multiple times.',
        ];

        yield 'basic enum type is not supported should return error' => [
            'configCaseName' => 'invalid-enum-type',
            'expectedMessage' => 'is not a BakedEnum',
        ];

        yield 'invalid definition yml format should return error' => [
            'configCaseName' => 'invalid-yml-format',
            'expectedMessage' => 'Failed to parse file',
        ];

        yield 'definition file include class without properties should return error' => [
            'configCaseName' => 'empty-property-definition',
            'expectedMessage' => 'Properties for class "AddressStatisticsTransfer" are not defined.',
        ];

        yield 'definitions were not found should return error' => [
            'configCaseName' => 'empty-definition-directory',
            'expectedMessage' => 'Missing Transfer Object definitions.',
        ];

        yield 'definition file is empty' => [
            'configCaseName' => 'empty-definition',
            'expectedMessage' => '',
        ];

        yield 'invalid type namespace' => [
            'configCaseName' => 'invalid-type-namespace',
            'expectedMessage' => 'Invalid namespace',
        ];

        yield 'invalid type namespace with alias' => [
            'configCaseName' => 'invalid-type-namespace-with-alias',
            'expectedMessage' => 'Invalid namespace',
        ];

        yield 'invalid date time type' => [
            'configCaseName' => 'invalid-date-time-type',
            'expectedMessage' => 'does not implement DateTimeInterface',
        ];

        yield 'invalid attribute name' => [
            'configCaseName' => 'invalid-attribute-name',
            'expectedMessage' => 'not found',
        ];

        yield 'invalid attribute' => [
            'configCaseName' => 'invalid-attribute',
            'expectedMessage' => 'is not an attribute',
        ];

        yield 'invalid attribute target' => [
            'configCaseName' => 'invalid-attribute-target',
            'expectedMessage' => 'is not allowed',
        ];

        yield 'duplicate type definition' => [
            'configCaseName' => 'duplicate-type-definition',
            'expectedMessage' => 'type definition is missing or set multiple times.',
        ];
    }

    #[TestDox('Failed to generate transfer objects')]
    public function testFailedToGenerateTransferObjects(): void
    {
        // Arrange
        $configPath = $this->getConfigPath('invalid-class-name');

        // Expect
        $this->expectException(TransferGeneratorException::class);

        // Act
        (void)new TransferGeneratorFacade()->generateTransfersOrFail($configPath);
    }

    private function getConfigPath(string $configCaseName): string
    {
        return sprintf(self::CONFIG_PATH_TEMPLATE, $configCaseName);
    }
}
