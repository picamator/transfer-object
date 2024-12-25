<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorHelperTrait;
use Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer;

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
        $messageTransfer = $this->loadConfig($configPath);
        $this->assertTrue($messageTransfer->isValid, $messageTransfer->errorMessage ?? '');

        $callback = function (?TransferGeneratorCallbackTransfer $generatorTransfer) use ($expectedMessage): void {
            if ($generatorTransfer === null) {
                return;
            }

            $this->assertFalse($generatorTransfer->validator->isValid);
            $this->assertCount(1, $generatorTransfer->validator->errorMessages);
            $this->assertSame($expectedMessage, $generatorTransfer->validator->errorMessages[0]->errorMessage);
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
            'expectedMessage' => 'Invalid class "00-AddressStatistics" name.',
        ];

        yield 'invalid collection type should return error' => [
            'configCaseName' => 'invalid-collection-type',
            'expectedMessage' => 'Invalid class "00Uuid" name.',
        ];

        yield 'invalid transfer type should return error' => [
            'configCaseName' => 'invalid-transfer-type',
            'expectedMessage' => 'Invalid class "00Uuid" name.',
        ];

        yield 'reserved property name should return error' => [
            'configCaseName' => 'reserved-property-name',
            'expectedMessage' => 'Cannot use reserved "_data" property name.',
        ];

        yield 'missed property type should return error' => [
            'configCaseName' => 'missed-type',
            'expectedMessage' => 'Property "addressUuid" type definition is missed.',
        ];

        yield 'unsupported type should return error' => [
            'configCaseName' => 'unsupported-type',
            'expectedMessage' => 'Property "addressBookUuid" type "object" is not supported.',
        ];

        yield 'property type defined with array yml structure should fail to recognize type and return error' => [
            'configCaseName' => 'invalid-type-definition',
            'expectedMessage' => 'Property "addressBookUuid" type definition is missed.',
        ];

        yield 'basic enum type is not supported should return error' => [
            'configCaseName' => 'invalid-enum-type',
            // phpcs:ignore
            'expectedMessage' => 'Property "addressType" type "\Picamator\Tests\Integration\TransferObject\TransferGenerator\Enum\AddressTypeEnum" is not BakedEnum.',
        ];
    }

    private function getConfigPath(string $configCaseName): string
    {
        return sprintf(self::CONFIG_PATH_TEMPLATE, $configCaseName);
    }
}
