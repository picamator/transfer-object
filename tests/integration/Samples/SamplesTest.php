<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Samples;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\OutputBufferHelperTrait;

class SamplesTest extends TestCase
{
    use OutputBufferHelperTrait;

    private const string SAMPLE_PATH = __DIR__ . '/../../../doc/samples/';

    #[DataProvider('samplesNameDataProvider')]
    public function testSamplesBufferOutputShouldSucceed(string $sampleName): void
    {
        // Arrange
        $samplePath = self::SAMPLE_PATH . $sampleName;

        // Act
        $actual = $this->getOutputBuffer($samplePath);
        $lastError = error_get_last();

        // Assert
        $this->assertNotFalse($actual);
        $this->assertNull($lastError);
    }

    /**
     * @return Generator<string,array<string,string>>
     */
    public static function samplesNameDataProvider(): Generator
    {
        yield 'try-transfer sample' => [
            'sampleName' => 'try-transfer.php',
        ];

        yield 'try-definition-generator sample' => [
            'sampleName' => 'try-definition-generator.php',
        ];
    }
}