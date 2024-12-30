<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorHelperTrait;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

class TransferGeneratorFacadeErrorTest extends TestCase
{
    use TransferGeneratorHelperTrait;

    private const string CONFIG_PATH_TEMPLATE = __DIR__ . '/data/error/%s/config/generator.config.yml';

    #[DataProvider('invalidDefinitionDataProvider')]
    public function testGenerateTransferObjectByInvalidDefinitionShouldFail(
        string $configCaseName,
        string $expectedMessage,
    ): void {
        // Arrange
        $configPath = $this->getConfigPath($configCaseName);
        $this->assertLoadConfigSuccess($configPath);

        $callback = function (?TransferGeneratorTransfer $generatorTransfer) use ($expectedMessage): void {
            if ($generatorTransfer === null) {
                return;
            }

            $this->assertFalse($generatorTransfer->validator->isValid);
            $this->assertCount(1, $generatorTransfer->validator->errorMessages);
            $this->assertStringContainsString(
                $expectedMessage,
                $generatorTransfer->validator->errorMessages[0]->errorMessage,
            );
        };

        // Act
        $actual = $this->generateTransfers($callback);

        // Assert
        $this->assertFalse($actual);
    }

    public function testGenerateTransferObjectByDuplicateDefinitionShouldFail(): void
    {
        $configCaseName = 'duplicate-transfer';

        // Arrange
        $configPath = $this->getConfigPath($configCaseName);
        $this->assertLoadConfigSuccess($configPath);

        $callback = function (?TransferGeneratorTransfer $generatorTransfer): void {
            if ($generatorTransfer === null || $generatorTransfer->validator->isValid) {
                return;
            }

            $this->assertFalse($generatorTransfer->validator->isValid);
            $this->assertCount(1, $generatorTransfer->validator->errorMessages);
            $this->assertStringContainsString(
                'A file with the same name already exists.',
                $generatorTransfer->validator->errorMessages[0]->errorMessage,
            );
        };

        // Act
        $actual = $this->generateTransfers($callback);

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

        yield 'reserved property name should return error' => [
            'configCaseName' => 'reserved-property-name',
            'expectedMessage' => 'Cannot use reserved property name',
        ];

        yield 'missed property type should return error' => [
            'configCaseName' => 'missed-type',
            'expectedMessage' => 'Property "addressUuid" type definition is missing.',
        ];

        yield 'unsupported type should return error' => [
            'configCaseName' => 'unsupported-type',
            'expectedMessage' => 'Property "addressBookUuid" with type "object" is not supported.',
        ];

        yield 'property type defined with array yml structure should fail to recognize type and return error' => [
            'configCaseName' => 'invalid-type-definition',
            'expectedMessage' => 'Property "addressBookUuid" type definition is missing.',
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
            'expectedMessage' => 'Class "AddressStatistics" properties were not defined.',
        ];

        yield 'definitions not found should return error' => [
            'configCaseName' => 'empty-definition-directory',
            'expectedMessage' => 'Missed Transfer Object definitions.',
        ];
    }

    private function getConfigPath(string $configCaseName): string
    {
        return sprintf(self::CONFIG_PATH_TEMPLATE, $configCaseName);
    }
}
