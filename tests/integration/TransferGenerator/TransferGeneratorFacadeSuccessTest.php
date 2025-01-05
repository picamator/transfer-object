<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorHelperTrait;

class TransferGeneratorFacadeSuccessTest extends TestCase
{
    use TransferGeneratorHelperTrait;

    private const string GENERATOR_CONFIG_PATH = __DIR__ . '/data/config/success/generator.config.yml';
    private const string TRANSFER_OBJECT_PATH = __DIR__ . '/Generated/Success/';

    private const array EXPECTED_GENERATED_TRANSFER_OBJECT = [
        self::TRANSFER_OBJECT_PATH . 'AddressBookTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'AddressStatisticsTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'AddressTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'CountryTransfer.php',
    ];

    public function testGenerateTransferObjectByValidDefinitionShouldSucceed(): void
    {
        // Act
        $actual = $this->generateTransfersCallback(self::GENERATOR_CONFIG_PATH, $this->assertGeneratorSuccess(...));

        // Assert
        $this->assertTrue($actual);
        foreach (self::EXPECTED_GENERATED_TRANSFER_OBJECT as $transferObjectFile) {
            $this->assertFileExists($transferObjectFile);
        }
    }
}
