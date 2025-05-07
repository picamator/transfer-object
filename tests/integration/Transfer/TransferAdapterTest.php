<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer;

use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Helper\ExtensionHelperTrait;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BcMathBookData;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BookData;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\CountryEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\AuthorTransfer;

class TransferAdapterTest extends TestCase
{
    use ExtensionHelperTrait;

    public function testFromArrayToArray(): void
    {
        // Arrange
        $expected = [
            'title' => 'Lalka',
            'author' => [
                AuthorTransfer::FIRST_NAME => 'Bolesław',
                AuthorTransfer::LAST_NAME => 'Prus',
            ],
            'country' => CountryEnum::PL->value,
            'storeData' => [
                'uuid' => '123-123-123-123',
            ],
            'labels' => ['wishlist'],
            'updatedAt' => '2025-05-01 21:39:18',
            'createdAt' => '2025-05-01 20:39:18',
            'notes' => [
                'title' => 'wishlist',
            ],
            'bookmarkPage' => null,
            'reference' => 'some reference',
        ];

        $bookData = new BookData()
            ->fromArray($expected);

        // Act
        $actual = $bookData->toArray();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function testToFilterArray(): void
    {
        // Arrange
        $bookData = new BookData();
        $expected = ['bookmarkPage' => 1];

        // Act
        $actual = $bookData->toFilterArray();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function testCount(): void
    {
        // Arrange
        $bookData = new BookData();
        $expected = count($bookData->toArray());

        // Act
        $actual = $bookData->count();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function testIterator(): void
    {
        // Arrange
        $bookData = new BookData();
        $expected = $bookData->toArray();

        // Act
        $actual = iterator_to_array($bookData);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function testClone(): void
    {
        // Arrange
        $expected = [
            'title' => 'Lalka',
            'author' => [
                AuthorTransfer::FIRST_NAME => 'Bolesław',
                AuthorTransfer::LAST_NAME => 'Prus',
            ],
            'country' => CountryEnum::PL->value,
            'storeData' => [
                'uuid' => '123-123-123-123',
            ],
            'labels' => ['wishlist'],
            'updatedAt' => '2025-05-01 21:39:18',
            'createdAt' => '2025-05-01 20:39:18',
            'notes' => [
                'title' => 'wishlist',
            ],
            'bookmarkPage' => null,
            'reference' => 'some reference',
        ];

        $bookData = new BookData()
            ->fromArray($expected);

        // Act
        $clonedBookData = clone $bookData;

        // Assert
        $this->assertSame($expected, $clonedBookData->toArray());
        $this->assertSame($bookData->country, $clonedBookData->country);
        $this->assertNotSame($bookData, $clonedBookData);
        $this->assertNotSame($bookData->author, $clonedBookData->author);
        $this->assertNotSame($bookData->storeData, $clonedBookData->storeData);
        $this->assertNotSame($bookData->labels, $clonedBookData->labels);
        $this->assertNotSame($bookData->updatedAt, $clonedBookData->updatedAt);
        $this->assertNotSame($bookData->createdAt, $clonedBookData->createdAt);
        $this->assertNotSame($bookData->notes, $clonedBookData->notes);
    }

    public function testDebugInfo(): void
    {
        // Arrange
        $bookData = new BookData();
        $expected = $bookData->toArray();

        // Act
        $actual = $bookData->__debugInfo();

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function testJsonSerialize(): void
    {
        // Arrange
        $bookData = new BookData();
        $expected = $bookData->toArray();

        // Act
        $actual = json_encode($bookData, flags: JSON_THROW_ON_ERROR);
        $actual = json_decode($actual, associative: true, flags: JSON_THROW_ON_ERROR);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function testBcMathToArray(): void
    {
        if (!$this->isBcMathLoaded()) {
            $this->markTestSkipped('BCMath is not loaded.');
        }

        // Arrange
        $expected = [
            'price' => '12.34'
        ];

        // Act
        $bookData = new BcMathBookData()
            ->fromArray($expected);

        $actual = $bookData->toArray();

        // Assert
        $this->assertSame($expected, $actual);
    }
}
