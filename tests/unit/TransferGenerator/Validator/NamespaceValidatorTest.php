<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Validator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\TransferGenerator\Validator\NamespaceValidatorTrait;

class NamespaceValidatorTest extends TestCase
{
    private NamespaceValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = new class () implements NamespaceValidatorInterface
        {
            use NamespaceValidatorTrait {
                isValidNamespace as public;
            }
        };
    }

    #[DataProvider('validNamespaceDataProvider')]
    public function testValidNamespaceShouldReturnTrue(string $namespace): void
    {
        // Act
        $actual = $this->validator->isValidNamespace($namespace);

        // Assert
        $this->assertTrue($actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function validNamespaceDataProvider(): Generator
    {
        yield 'many sections namespace' => [
            'Picamator\Tests\Unit\TransferObject\TransferGenerator\Validator',
        ];

        yield 'many sections namespace with first uppercase chars' => [
            'PHPUnit\Framework\TestCase',
        ];

        yield 'two section namespace' => [
            'Picamator\Tests',
        ];

        yield 'one section namespace' => [
            'Picamator',
        ];
    }
}