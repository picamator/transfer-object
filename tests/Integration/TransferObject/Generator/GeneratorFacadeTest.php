<?php declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Generator;

use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Config\ConfigFacade;
use Picamator\TransferObject\Config\ConfigFacadeInterface;
use Picamator\TransferObject\Generator\GeneratorFacade;
use Picamator\TransferObject\Generator\GeneratorFacadeInterface;
use Picamator\TransferObject\Transfer\Generated\GeneratorTransfer;

class GeneratorFacadeTest extends TestCase
{
    private const string CONFIG_PATH = __DIR__ . '/../../data/generator/config/generator.yml';

    private ConfigFacadeInterface $configFacade;

    private GeneratorFacadeInterface $generatorFacade;

    protected function setUp(): void
    {
        $this->configFacade = new ConfigFacade();
        $this->generatorFacade = new GeneratorFacade();
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

        $this->assertTrue($generatorTransfer->validator?->isValid);
    }
}
