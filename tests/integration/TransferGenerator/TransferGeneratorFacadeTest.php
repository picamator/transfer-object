<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\GeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFacade;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFacadeInterface;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;

class TransferGeneratorFacadeTest extends TestCase
{
    private const string CONFIG_PATH = __DIR__ . '/data/config/generator.config.yml';

    private ConfigFacadeInterface $configFacade;

    private TransferGeneratorFacadeInterface $generatorFacade;

    protected function setUp(): void
    {
        $this->configFacade = new ConfigFacade();
        $this->generatorFacade = new TransferGeneratorFacade();
    }

    #[TestDox('Generates Transfer Objects with valid definition file.')]
    public function testGenerateTransferObjectByValidConfigurationShouldSucceed(): void
    {
        // Arrange
        $this->configFacade->loadConfig(self::CONFIG_PATH);

        // Act
        $actual = $this->generatorFacade->generateTransfers($this->assertGeneratorCallback(...));

        // Assert
        $this->assertTrue($actual);
    }

    private function assertGeneratorCallback(?GeneratorTransfer $generatorTransfer): void
    {
        if ($generatorTransfer === null) {
            return;
        }

        $validatorTransfer = $generatorTransfer->validator;
        $assertMessage = 'Fail generate Transfer Object'
            . PHP_EOL . var_export($validatorTransfer->toArray(), true);

        $this->assertTrue(
            $validatorTransfer?->isValid,
            $assertMessage,
        );
    }
}
