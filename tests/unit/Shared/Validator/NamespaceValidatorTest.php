<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Validator;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Shared\Validator\NamespaceValidatorTrait;

#[Group('shared')]
class NamespaceValidatorTest extends TestCase
{
    private NamespaceValidatorInterface $validator;

    protected function setUp(): void
    {
        $this->validator = new readonly class () implements NamespaceValidatorInterface
        {
            use NamespaceValidatorTrait {
                isValidNamespace as public;
            }
        };
    }

    #[DataProvider('validNamespaceDataProvider')]
    #[TestDox('Valid namespace "$namespace"')]
    public function testValidNamespace(string $namespace): void
    {
        // Act
        $actual = $this->validator->isValidNamespace($namespace);

        // Assert
        $this->assertTrue($actual, sprintf('Invalid namespace "%s".', $namespace));
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
