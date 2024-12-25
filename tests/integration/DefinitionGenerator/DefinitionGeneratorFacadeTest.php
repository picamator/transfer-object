<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\DefinitionGeneratorHelperTrait;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorHelperTrait;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacadeInterface;

class DefinitionGeneratorFacadeTest extends TestCase
{
    use DefinitionGeneratorHelperTrait;
    use TransferGeneratorHelperTrait;

    private const string SAMPLE_JSON_PATH = __DIR__ . '/data/json-samples/';
    private const string DEFINITION_PATH = __DIR__ . '/data/config/definition';

    private const string TRANSFER_OBJECT_GENERATOR_CONFIG_PATH = __DIR__ . '/data/config/generator.config.yml';

    private DefinitionGeneratorFacadeInterface $definitionGeneratorFacade;

    protected function setUp(): void
    {
        $this->definitionGeneratorFacade = new DefinitionGeneratorFacade();
    }

    #[DataProvider('generateDefinitionDataProvider')]
    public function testGenerateDefinition(
        string $className,
        string $sampleFileName,
        string $definitionFileName,
    ): void {
        // Arrange
        $generatedPath = self::DEFINITION_PATH . DIRECTORY_SEPARATOR . $definitionFileName;
        $sampleJsonPath = self::SAMPLE_JSON_PATH . $sampleFileName;

        $generatorTransfer = $this->createDefinitionGenerator(
            definitionPath:self::DEFINITION_PATH,
            className: $className,
            sampleJsonPath: $sampleJsonPath,
        );

        // Act
        $actual = $this->definitionGeneratorFacade->generateDefinitions($generatorTransfer);

        // Assert
        $this->assertNotSame(0, $actual);
        $this->assertFileExists($generatedPath);
    }

    #[Depends('testGenerateDefinition')]
    public function testGenerateTransferBasedOnDefinition(): void
    {
        // Arrange
        $messageTransfer = $this->loadConfig(self::TRANSFER_OBJECT_GENERATOR_CONFIG_PATH);
        $this->assertTrue($messageTransfer->isValid, $messageTransfer->errorMessage ?? '');

        // Act
        $actual = $this->generateTransfers($this->assertGenerateTransferSuccessCallback(...));

        // Assert
        $this->assertTrue($actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function generateDefinitionDataProvider(): Generator
    {
        yield 'NASA NEO asteroid 465633 (2009 JR5)' => [
            'className' => 'Asteroid',
            'sampleFileName' => 'nasa-neo-rest-v1-neo-2465633.json',
            'definitionFileName' => 'asteroid.transfer.yml',
        ];

        yield 'Open Weather Response' => [
            'className' => 'Forecast',
            'sampleFileName' => 'open-weather.json',
            'definitionFileName' => 'forecast.transfer.yml',
        ];
    }
}
