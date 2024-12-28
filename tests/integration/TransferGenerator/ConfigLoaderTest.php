<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacade;
use Picamator\TransferObject\TransferGenerator\TransferGeneratorFacadeInterface;

class ConfigLoaderTest extends TestCase
{
    private const string CONFIG_PATH = __DIR__ . '/data/config/';

    private TransferGeneratorFacadeInterface $generatorFacade;

    protected function setUp(): void
    {
        $this->generatorFacade = new TransferGeneratorFacade();
    }

    #[DataProvider('invalidConfigDataProvider')]
    public function testInvalidConfigShouldReturnError(string $configName): void
    {
        // Arrange
        $configPath = self::CONFIG_PATH . $configName;

        // Act
        $actual = $this->generatorFacade->loadConfig($configPath);

        // Assert
        $this->assertFalse($actual->validator->isValid);
        $this->assertCount(1, $actual->validator->errorMessages);
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

        yield 'invalid yml format' => ['invalid-yml-format.config.yml'];
    }
}
