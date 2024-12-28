<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\AsteroidTransfer;
use Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\ForecastTransfer;
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

    private const string CONFIG_PATH = __DIR__ . '/data/config/generator.config.yml';

    private DefinitionGeneratorFacadeInterface $definitionGeneratorFacade;

    protected function setUp(): void
    {
        $this->definitionGeneratorFacade = new DefinitionGeneratorFacade();
    }

    #[DataProvider('generateDefinitionDataProvider')]
    public function testGenerateDefinitionShouldSuccessfullyCreateDefinitionFile(
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

    #[Depends('testGenerateDefinitionShouldSuccessfullyCreateDefinitionFile')]
    public function testGenerateTransferBasedOnDefinitionShouldSuccessfullyGenerateTransferObjects(): void
    {
        // Arrange
        $this->assertLoadConfigSuccess(self::CONFIG_PATH);

        // Act
        $actual = $this->generateTransfers($this->assertGeneratorSuccess(...));

        // Assert
        $this->assertTrue($actual);
    }

    #[DataProvider('matchDefinitionDataProvider')]
    #[Depends('testGenerateTransferBasedOnDefinitionShouldSuccessfullyGenerateTransferObjects')]
    public function testCompareSampleDataWithTransferObjectShouldSuccessfullyMatch(
        string $classFullName,
        string $sampleFileName,
    ): void {
        // Arrange
        $this->assertTrue(class_exists($classFullName), sprintf('Class %s does not exist.', $classFullName));

        /** @var \Picamator\TransferObject\Transfer\TransferInterface $transfer */
        $transfer = new $classFullName();

        $sampleJsonPath = self::SAMPLE_JSON_PATH . $sampleFileName;
        $sampleContent = $this->getSampleContent($sampleJsonPath);

        // Act
        $transfer->fromArray($sampleContent);
        $actual = $transfer->toArray();

        // Assert
        $this->assertEquals($sampleContent, $actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function matchDefinitionDataProvider(): Generator
    {
        yield 'NASA NEO asteroid 465633 (2009 JR5)' => [
            AsteroidTransfer::class,
            'nasa-neo-rest-v1-neo-2465633.json',
        ];

        yield 'Open Weather Response' => [
            ForecastTransfer::class,
            'open-weather.json',
        ];
    }
}
