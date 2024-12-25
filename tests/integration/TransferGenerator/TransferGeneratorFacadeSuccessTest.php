<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorHelperTrait;

class TransferGeneratorFacadeSuccessTest extends TestCase
{
    use TransferGeneratorHelperTrait;

    private const string GENERATOR_CONFIG_PATH = __DIR__ . '/data/success/config/generator.config.yml';
    private const string TRANSFER_OBJECT_PATH = __DIR__ . '/Generated/';

    private const array EXPECTED_GENERATED_TRANSFER_OBJECT = [
        self::TRANSFER_OBJECT_PATH . 'AddressBookTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'AddressStatisticsTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'AddressTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'CountryTransfer.php',
    ];

    public function testGenerateTransferObjectByValidDefinitionShouldSucceed(): void
    {
        // Arrange
        $messageTransfer = $this->loadConfig(self::GENERATOR_CONFIG_PATH);
        $this->assertTrue($messageTransfer->isValid, $messageTransfer->errorMessage ?? '');

        // Act
        $actual = $this->generateTransfers($this->assertGenerateTransferSuccessCallback(...));

        // Assert
        $this->assertTrue($actual);
        foreach (self::EXPECTED_GENERATED_TRANSFER_OBJECT as $transferObjectFile) {
            $this->assertFileExists($transferObjectFile);
        }
    }
}
