<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorTrait;

#[Group('transfer-generator')]
class TransferGeneratorFacadeSuccessTest extends TestCase
{
    use TransferGeneratorTrait;

    private const string GENERATOR_CONFIG_PATH = __DIR__ . '/data/config/success/generator.config.yml';
    private const string TRANSFER_OBJECT_PATH = __DIR__ . '/Generated/Success/';

    private const array EXPECTED_GENERATED_TRANSFER_OBJECT = [
        self::TRANSFER_OBJECT_PATH . 'AddressBookTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'AddressStatisticsTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'AddressTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'CountryTransfer.php',
    ];

    #[TestDox('Generate transfer objects by valid definition')]
    public function testGenerateTransferObjectsByValidDefinition(): void
    {
        // Act
        $actual = $this->generateTransfersCallback(self::GENERATOR_CONFIG_PATH, $this->assertGeneratorSuccess(...));

        // Assert
        $this->assertTrue($actual, 'Failed to generate transfer objects.');
        foreach (self::EXPECTED_GENERATED_TRANSFER_OBJECT as $transferObjectFile) {
            $this->assertFileExists($transferObjectFile);
        }
    }
}
