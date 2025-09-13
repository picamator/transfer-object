<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer;

use PHPUnit\Framework\Attributes\Group;
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

    public function testFromArrayToArray(): void
    {
        // Arrange
        $bookmarkData = $this->bookmarkData
            ->fromArray([
                'bookmark' => 'some bookmark',
            ]);

        // Act
        $actual = $bookmarkData->toArray();

        // Assert
        $this->assertSame([], $actual);
    }

    public function testToFilterArray(): void
    {
        // Act
        $actual = $this->bookmarkData->toFilterArray();

        // Assert
        $this->assertSame([], $actual);
    }

    public function testCount(): void
    {
        // Act
        $actual = $this->bookmarkData->count();

        // Assert
        $this->assertSame(0, $actual);
    }

    public function testIterator(): void
    {
        // Act
        $actual = iterator_to_array($this->bookmarkData);

        // Assert
        $this->assertSame([], $actual);
    }

    public function testDebugInfo(): void
    {
        // Act
        $actual = $this->bookmarkData->__debugInfo();

        // Assert
        $this->assertSame([], $actual);
    }

    public function testJsonSerialize(): void
    {
        // Act
        $actual = json_encode($this->bookmarkData, flags: JSON_THROW_ON_ERROR);

        // Assert
        $this->assertSame('[]', $actual);
    }
}
