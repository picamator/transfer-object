<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacade;
use Picamator\TransferObject\DefinitionGenerator\DefinitionGeneratorFacadeInterface;

class DefinitionGeneratorFacadeTest extends TestCase
{
    use DefinitionGeneratorFacadeTrait;

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
        $definitionPath = self::DEFINITION_PATH . DIRECTORY_SEPARATOR . $definitionFileName;

        $generatorTransfer = $this->createDefinitionGenerator($className, $sampleFileName);

        // Act
        $actual = $this->definitionGeneratorFacade->generateDefinitions($generatorTransfer);

        // Assert
        $this->assertNotSame(0, $actual);
        $this->assertFileExists($definitionPath);
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
    }
}
