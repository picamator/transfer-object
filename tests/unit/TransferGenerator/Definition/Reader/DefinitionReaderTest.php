<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Reader;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FinderException;
use Picamator\TransferObject\TransferGenerator\Definition\Filesystem\DefinitionFinderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\DefinitionParserInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReader;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\DefinitionValidatorInterface;

class DefinitionReaderTest extends TestCase
{
    private DefinitionReaderInterface $reader;

    private DefinitionFinderInterface&MockObject $finderMock;

    private DefinitionParserInterface&MockObject $parserMock;

    private DefinitionValidatorInterface&MockObject $validatorMock;

    protected function setUp(): void
    {
        $this->finderMock = $this->createMock(DefinitionFinderInterface::class);

        $this->parserMock = $this->createMock(DefinitionParserInterface::class);

        $this->validatorMock = $this->createMock(DefinitionValidatorInterface::class);

        $this->reader = new DefinitionReader(
            $this->finderMock,
            $this->parserMock,
            $this->validatorMock,
        );
    }

    public function testFInderRiseExceptionShouldReturnZeroOnDefinitionFileCount(): void
    {
        // Arrange

        $this->finderMock->expects($this->once())
            ->method('getDefinitionFileCount')
            ->willThrowException(new FinderException());

        // Act
        $actual = $this->reader->getDefinitionFileCount();

        // Assert
        $this->assertSame(0, $actual);
    }
}
