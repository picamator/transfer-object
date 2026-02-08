<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Adapter;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BookmarkData;

#[Group('transfer')]
class DummyTransferAdapterTest extends TestCase
{
    private BookmarkData $bookmarkData;

    protected function setUp(): void
    {
        $this->bookmarkData = new BookmarkData();
    }

    #[TestDox('Transformation fromArray() and toArray()')]
    public function testTransformationFromArrayToArray(): void
    {
        // Arrange
        $bookmarkData = $this->bookmarkData
            ->fromArray([
                'bookmark' => 'some bookmark',
            ]);

        // Act
        $actual = $bookmarkData->toArray();

        // Assert
        $this->assertArraysAreIdentical([], $actual);
    }

    #[TestDox('Transfer count()')]
    public function testTransferCount(): void
    {
        // Act
        $actual = $this->bookmarkData->count();

        // Assert
        $this->assertSame(0, $actual);
    }

    #[TestDox('Transfer iterator')]
    public function testTransferIterator(): void
    {
        // Act
        $actual = iterator_to_array($this->bookmarkData);

        // Assert
        $this->assertArraysAreIdentical([], $actual);
    }

    #[TestDox('Transfer debugInfo()')]
    public function testTransferDebugInfo(): void
    {
        // Act
        $actual = $this->bookmarkData->__debugInfo();

        // Assert
        $this->assertArraysAreIdentical([], $actual);
    }

    #[TestDox('Transfer jsonSerialize')]
    public function testTransferJsonSerialize(): void
    {
        // Act
        $actual = json_encode($this->bookmarkData, flags: JSON_THROW_ON_ERROR);

        // Assert
        $this->assertJsonStringEqualsJsonString('[]', $actual);
    }
}
