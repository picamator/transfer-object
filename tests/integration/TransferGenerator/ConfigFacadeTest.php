<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFacade;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFacadeInterface;

class ConfigFacadeTest extends TestCase
{
    private const string CONFIG_PATH = __DIR__ . '/data/config/';

    private ConfigFacadeInterface $configFacade;

    protected function setUp(): void
    {
        $this->configFacade = new ConfigFacade();
    }

    #[DataProvider('invalidConfigDataProvider')]
    public function testInvalidConfigShouldReturnError(string $configName): void
    {
        // Arrange
        $configPath = self::CONFIG_PATH . $configName;

        // Act
        $actual = $this->configFacade->loadConfig($configPath);

        // Assert
        $this->assertFalse($actual->isValid);
        $this->assertNotEmpty($actual->errorMessage);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function invalidConfigDataProvider(): Generator
    {
        yield 'config file does not exist' => ['config-file-does-not-exist.config.yml'];

        yield 'missed required keys' => ['missed-required-keys.config.yml'];

        yield 'definition path is not exist' => ['definition-path-is-not-exist.config.yml'];

        yield 'invalid namespace' => ['invalid-transfer-namespace.config.yml'];
    }
}
