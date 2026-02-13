<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Parser;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Shared\Parser\DocBlockParserTrait;

#[Group('shared')]
final class DocBlockParserTest extends TestCase
{
    private DocBlockParserInterface $docBlockParser;

    protected function setUp(): void
    {
        $this->docBlockParser = new class () implements DocBlockParserInterface {
            use DocBlockParserTrait {
                parseTypeWithDocBlock as public;
            }
        };
    }

    #[TestWith(['ArrayObject', 'ArrayObject', null])]
    #[TestWith(['ArrayObject<int, string>', 'ArrayObject', '<int, string>'])]
    #[TestWith(['ArrayObject <int, string>', 'ArrayObject', '<int, string>'])]
    #[TestDox('Parse type "$type" expected type "$expectedType" and docBlock "$expectedDocBlock"')]
    public function testParseTypeWithDocBlock(string $type, string $expectedType, ?string $expectedDocBlock): void
    {
        // Act
        $actual = $this->docBlockParser->parseTypeWithDocBlock($type);

        // Assert
        $this->assertSame($expectedType, $actual->type);
        $this->assertSame($expectedDocBlock, $actual->docBlock);
    }
}
