<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFacade;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFacadeInterface;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;

class SuccessTransferGeneratorFacadeTest extends TestCase
{
    use TransferGeneratorFacadeTrait;

    private const string CONFIG_PATH = __DIR__ . '/data/success/config/generator.config.yml';
    private const string TRANSFER_OBJECT_PATH = __DIR__ . '/Generated/';

    private const array EXPECTED_GENERATED_TRANSFER_OBJECT = [
        self::TRANSFER_OBJECT_PATH . 'AddressBookTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'AddressStatisticsTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'AddressTransfer.php',
        self::TRANSFER_OBJECT_PATH . 'CountryTransfer.php',
    ];

    private ConfigFacadeInterface $configFacade;

    protected function setUp(): void
    {
        $this->configFacade = new ConfigFacade();
    }

    #[TestDox('Generates Transfer Objects with valid definition file.')]
    public function testGenerateTransferObjectByValidConfigurationShouldSucceed(): void
    {
        // Arrange
        $this->configFacade->loadConfig(self::CONFIG_PATH);

        // Act
        $actual = $this->generateTransfers($this->assertGeneratorCallback(...));

        // Assert
        $this->assertTrue($actual);
        foreach (self::EXPECTED_GENERATED_TRANSFER_OBJECT as $transferObjectFile) {
            $this->assertFileExists($transferObjectFile);
        }
    }

    private function assertGeneratorCallback(?TransferGeneratorCallbackTransfer $generatorTransfer): void
    {
        if ($generatorTransfer === null) {
            return;
        }

        $assertMessage = '';
        if (!$generatorTransfer->validator->isValid) {
            $assertMessage = 'Fail generate Transfer Object'
                . PHP_EOL . var_export($generatorTransfer->toArray(), true);
        }

        $this->assertTrue(
            $generatorTransfer->validator->isValid,
            $assertMessage,
        );
    }
}
