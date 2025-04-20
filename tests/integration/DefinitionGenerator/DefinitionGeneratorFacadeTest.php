<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Frankfurter\ExchangeRateTransfer;
use Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\GoogleShoppingContent\ProductTransfer;
use Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo\AsteroidTransfer;
use Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather\ForecastTransfer;
use Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau\ArdNewsTransfer;
use Picamator\Tests\Integration\TransferObject\Helper\DefinitionGeneratorHelperTrait;
use Picamator\Tests\Integration\TransferObject\Helper\TransferGeneratorHelperTrait;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacadeInterface;

class DefinitionGeneratorFacadeTest extends TestCase
{
    use DefinitionGeneratorHelperTrait;
    use TransferGeneratorHelperTrait;

    private const string SAMPLE_JSON_PATH = __DIR__ . '/data/json-samples/';

    private const string DEFINITION_PATH_TEMPLATE = __DIR__ . '/data/config/%s/definition';
    private const string CONFIG_PATH_TEMPLATE = __DIR__ . '/data/config/%s/generator.config.yml';

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
        $pathPlaceholder = pathinfo($sampleFileName, PATHINFO_FILENAME);
        $definitionPath = sprintf(self::DEFINITION_PATH_TEMPLATE, $pathPlaceholder);

        $generatedPath = $definitionPath . DIRECTORY_SEPARATOR . $definitionFileName;

        $sampleJsonPath = self::SAMPLE_JSON_PATH . $sampleFileName;

        $generatorTransfer = $this->createDefinitionGenerator(
            definitionPath:$definitionPath,
            className: $className,
            sampleJsonPath: $sampleJsonPath,
        );

        // Act
        $actual = $this->definitionGeneratorFacade->generateDefinitions($generatorTransfer);

        // Assert
        $this->assertGreaterThan(0, $actual);
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

        yield 'Google Shopping Content' => [
            'className' => 'Product',
            'sampleFileName' => 'google-shopping-content.json',
            'definitionFileName' => 'product.transfer.yml',
        ];

        yield 'Frankfurter' => [
            'className' => 'ExchangeRate',
            'sampleFileName' => 'frankfurter-dev-v1.json',
            'definitionFileName' => 'exchangeRate.transfer.yml',
        ];

        yield 'Tagesschau' => [
            'className' => 'ArdNews',
            'sampleFileName' => 'tagesschau-api-bund-dev-v2.json',
            'definitionFileName' => 'ardNews.transfer.yml',
        ];
    }

    #[DataProvider('configPathDataProvider')]
    #[Depends('testGenerateDefinitionShouldSuccessfullyCreateDefinitionFile')]
    public function testGenerateTransferBasedOnDefinitionShouldSuccessfullyGenerateTransferObjects(
        string $sampleFileName,
    ): void {
        // Arrange
        $pathPlaceholder = pathinfo($sampleFileName, PATHINFO_FILENAME);
        $configPath = sprintf(self::CONFIG_PATH_TEMPLATE, $pathPlaceholder);

        // Act
        $actual = $this->generateTransfersCallback($configPath, $this->assertGeneratorSuccess(...));

        // Assert
        $this->assertTrue($actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function configPathDataProvider(): Generator
    {
        yield 'NASA NEO asteroid 465633' => [
            'nasa-neo-rest-v1-neo-2465633.json',
        ];

        yield 'Open Weather Response' => [
            'open-weather.json',
        ];

        yield 'Google Shopping Content' => [
            'google-shopping-content.json',
        ];

        yield 'Frankfurter' => [
            'frankfurter-dev-v1.json',
        ];

        yield 'Tagesschau' => [
            'tagesschau-api-bund-dev-v2.json',
        ];
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

        yield 'Google Shopping Content' => [
            ProductTransfer::class,
            'google-shopping-content.json',
        ];

        yield 'Frankfurter' => [
            ExchangeRateTransfer::class,
            'frankfurter-dev-v1.json',
        ];
    }

    #[DataProvider('matchFilteredDefinitionDataProvider')]
    #[Depends('testGenerateTransferBasedOnDefinitionShouldSuccessfullyGenerateTransferObjects')]
    public function testCompareFilteredSampleDataWithTransferObjectShouldSuccessfullyMatch(
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
        $actual = $transfer->toFilterArray(fn (mixed $item): bool => $item !== null);

        // Assert
        $this->assertEquals($sampleContent, $actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function matchFilteredDefinitionDataProvider(): Generator
    {
        yield 'Tagesschau' => [
            ArdNewsTransfer::class,
            'tagesschau-api-bund-dev-v2.json',
        ];
    }
}
