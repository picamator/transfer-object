<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Command\Helper;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Command\Helper\InputNormalizerTrait;

class InputNormalizerTest extends TestCase
{
    private InputNormalizerInterface $inputNormalizer;

    protected function setUp(): void
    {
        $this->inputNormalizer = new class () implements InputNormalizerInterface
        {
            use InputNormalizerTrait {
                normalizePath as public;
                normalizeInput as public;
            }
        };
    }

    #[DataProvider('normalizePathDataProvider')]
    public function testNormalizePath(?string $path, string $expected): void
    {
        // Act
        $actual = $this->inputNormalizer->normalizePath($path);

        // Assert
        $this->assertSame($expected, $actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function normalizePathDataProvider(): Generator
    {
        $workingDirectory = getcwd() ?: '';
        $workingDirectory .= DIRECTORY_SEPARATOR;

        yield 'path is null' => [
            'path' => null,
            'expected' => '',
        ];

        yield 'path is empty' => [
            'path' => '  ',
            'expected' => '',
        ];

        yield 'path with empty string and back-slash' => [
            'path' => '  \some\path ',
            'expected' => $workingDirectory . 'some\path',
        ];

        yield 'path with empty string and slash' => [
            'path' => '  /some/path ',
            'expected' => $workingDirectory . 'some/path',
        ];

        yield 'path is remote with spaces' => [
            'path' => ' https://some-domain.io/ ',
            'expected' => 'https://some-domain.io/',
        ];
    }
}
