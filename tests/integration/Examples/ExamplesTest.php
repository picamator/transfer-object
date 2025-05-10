<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Examples;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\WithoutErrorHandler;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\OutputBufferHelperTrait;

class ExamplesTest extends TestCase
{
    use OutputBufferHelperTrait;

    private const string EXAMPLE_PATH = __DIR__ . '/../../../examples/';

    #[WithoutErrorHandler]
    #[DataProvider('examplesNameDataProvider')]
    public function testExamplesBufferOutputShouldSucceed(string $exampleName): void
    {
        // Arrange
        $examplePath = self::EXAMPLE_PATH . $exampleName;

        // Act
        $actual = $this->getOutputBuffer($examplePath);
        $lastError = error_get_last();

        // Assert
        $this->assertNotFalse($actual);
        $this->assertNull($lastError);
    }

    /**
     * @return Generator<string,array<string,string>>
     */
    public static function examplesNameDataProvider(): Generator
    {
        yield 'try-definition-generator' => [
            'exampleName' => 'try-definition-generator.php',
        ];

        yield 'try-transfer-generator' => [
            'exampleName' => 'try-transfer-generator.php',
        ];

        yield 'try-advanced-transfer-generator' => [
            'exampleName' => 'try-advanced-transfer-generator.php',
        ];
    }
}
