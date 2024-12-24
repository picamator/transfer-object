<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFacade;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFacadeInterface;

class TransferGeneratorFacadeSuccessTest extends TestCase
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

    public function testGenerateTransferObjectByValidDefinitionShouldSucceed(): void
    {
        // Arrange
        $messageTransfer = $this->configFacade->loadConfig(self::CONFIG_PATH);
        $this->assertTrue($messageTransfer->isValid, $messageTransfer->errorMessage ?? '');

        // Act
        $actual = $this->generateTransfers($this->assertCallback(...));

        // Assert
        $this->assertTrue($actual);
        foreach (self::EXPECTED_GENERATED_TRANSFER_OBJECT as $transferObjectFile) {
            $this->assertFileExists($transferObjectFile);
        }
    }

    private function assertCallback(?TransferGeneratorCallbackTransfer $generatorTransfer): void
    {
        if ($generatorTransfer === null) {
            return;
        }

        $isValid = $generatorTransfer->validator->isValid;
        $assertMessage = !$isValid
            ? 'Fail asserting success' . PHP_EOL . var_export($generatorTransfer->toArray(), true)
            : '';

        $this->assertTrue($isValid, $assertMessage);
    }
}
