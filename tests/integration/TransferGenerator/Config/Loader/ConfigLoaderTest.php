<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Config\Loader;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\TransferGenerator\Config\ConfigFactory;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;

#[Group('transfer-generator')]
class ConfigLoaderTest extends TestCase
{
    private const string CONFIG_PATH = __DIR__ . '/../../data/config/error/';

    private ConfigLoaderInterface $configLoader;

    protected function setUp(): void
    {
        $this->configLoader = new ConfigFactory()->createConfigLoader();
    }

    #[DataProvider('invalidConfigDataProvider')]
    public function testInvalidConfigShouldReturnError(string $configName): void
    {
        // Arrange
        $configPath = self::CONFIG_PATH . $configName;

        // Act
        $actual = $this->configLoader->loadConfig($configPath);

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function invalidConfigDataProvider(): Generator
    {
        yield 'config file does not exist' => ['config-file-does-not-exist.config.yml'];

        yield 'missed required keys' => ['missed-required-keys.config.yml'];

        yield 'definition path is not local' => ['definition-path-is-not-exist.config.yml'];

        yield 'definition path is not exist' => ['definition-path-is-not-local.config.yml'];

        yield 'invalid namespace' => ['invalid-transfer-namespace.config.yml'];

        yield 'invalid yml format' => ['invalid-yml-format.config.yml'];

        yield 'empty config file' => ['empty.config.yml'];

        yield 'invalid definition root key' => ['invalid-definition-root-key.config.yml'];

        yield 'transfer path is not exist' => ['transfer-path-is-not-local.config.yml'];
    }
}
