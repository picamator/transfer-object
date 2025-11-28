<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Adapter;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BcMathBookData;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BookAuthorData;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BookData;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\CountryEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\AuthorTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ReservedAdvancedTransfer;

#[Group('transfer')]
class TransferAdapterTest extends TestCase
{
    #[TestDox('Transformation fromArray and toArray')]
    public function testTransformationFromArrayToArray(): void
    {
        // Arrange
        $expected = [
            'title' => 'Lalka',
            'author' => [
                AuthorTransfer::FIRST_NAME_PROP => 'Bolesław',
                AuthorTransfer::LAST_NAME_PROP => 'Prus',
            ],
            'country' => CountryEnum::PL->value,
            'storeData' => [
                'uuid' => '123-123-123-123',
            ],
            'labels' => ['wishlist'],
            'updatedAt' => '2025-05-01T21:39:18+00:00',
            'createdAt' => '2025-05-01T20:39:18+00:00',
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

    #[TestDox('Transformation fromArray on partly initialized properties')]
    public function testTransformationFromArrayOnPartlyInitializedProperties(): void
    {
        // Arrange
        $expected = ['lastName' => 'Kowalski'];

        $bookAuthorData = new BookAuthorData();
        $bookAuthorData->lastName = 'Kowalski';

        // Act
        $actual = $bookAuthorData->toArray();

        // Assert
        $this->assertSame($expected, $actual);
    }

    #[TestDox('Transformation fromArray and toArray with reserved properties')]
    public function testTransformationFromArrayToArrayWithReservedProperties(): void
    {
        // Arrange
        $expected = [
            ReservedAdvancedTransfer::DATA_PROP => [
                '_data' => 'data',
            ],
        ];

        $reserverPropertyData = new ReservedAdvancedTransfer()
            ->fromArray($expected);

        // Act
        $actual = $reserverPropertyData->toArray();

        // Assert
        $this->assertSame($expected, $actual);
        $this->assertSame($expected[ReservedAdvancedTransfer::DATA_PROP]['_data'], $reserverPropertyData->data->_data);
    }

    #[TestDox('Transfer count')]
    public function testTransferCount(): void
    {
        // Arrange
        $bookData = new BookData();
        $expected = count($bookData->toArray());

        // Act
        $actual = $bookData->count();

        // Assert
        $this->assertSame($expected, $actual);
    }

    #[TestDox('Transfer iterator')]
    public function testTransferIterator(): void
    {
        // Arrange
        $bookData = new BookData();
        $expected = $bookData->toArray();

        // Act
        $actual = iterator_to_array($bookData);

        // Assert
        $this->assertSame($expected, $actual);
    }

    #[TestDox('Iterator on partly initialized properties')]
    public function testIteratorOnPartlyInitializedProperties(): void
    {
        // Arrange
        $expected = ['firstName' => 'Jan'];

        $bookAuthorData = new BookAuthorData();
        $bookAuthorData->firstName = 'Jan';

        // Act
        $actual = iterator_to_array($bookAuthorData);

        // Assert
        $this->assertSame($expected, $actual);
    }

    #[TestDox('Transfer clone')]
    public function testTransferClone(): void
    {
        // Arrange
        $expected = [
            'title' => 'Lalka',
            'author' => [
                AuthorTransfer::FIRST_NAME_PROP => 'Bolesław',
                AuthorTransfer::LAST_NAME_PROP => 'Prus',
            ],
            'country' => CountryEnum::PL->value,
            'storeData' => [
                'uuid' => '123-123-123-123',
            ],
            'labels' => ['wishlist'],
            'updatedAt' => '2025-05-01T21:39:18+00:00',
            'createdAt' => '2025-05-01T20:39:18+00:00',
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

    #[TestDox('Transfer debugInfo')]
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

    #[TestDox('Transfer jsonSerialize')]
    public function testTransferJsonSerialize(): void
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

    #[TestDox('Transformation date time $dateTime to $expected by toArray')]
    #[TestWith(['2025-05-01T21:39:18+00:00', '2025-05-01T21:39:18+00:00'], 'Date and date time immutable are string')]
    #[TestWith([1759419659, '2025-10-02T15:40:59+00:00'], 'Date and date time immutable are integer timestamp')]
    #[TestWith([1759419693.3584, '2025-10-02T15:41:33+00:00'], 'Date and date time immutable are float microtime')]
    public function testDateTimeTransformationFromToArray(string|int|float $dateTime, string $expected): void
    {
        // Act
        $bookData = new BookData()
            ->fromArray([
                'updatedAt' => $dateTime,
                'createdAt' => $dateTime,
            ]);

        $actual = $bookData->toArray();

        // Assert
        $this->assertSame($expected, $actual['updatedAt']);
        $this->assertSame($expected, $actual['createdAt']);
    }

    #[RequiresPhpExtension('bcmath')]
    #[TestDox('Transformation $price as BcMath Number toArray')]
    #[TestWith(['12.34'], 'Price is string')]
    #[TestWith([12], 'Price is integer')]
    public function testBcMathTransformationToArray(string|int $price): void
    {
        // Arrange
        $expected = [
            'price' => $price,
        ];

        // Act
        $bookData = new BcMathBookData()
            ->fromArray($expected);

        $actual = $bookData->toArray();

        // Assert
        $this->assertEquals($expected, $actual);
    }
}
