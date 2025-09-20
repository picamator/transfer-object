<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BcMathBookData;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BookAuthorData;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BookData;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\CountryEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\AuthorTransfer;

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

    #[RequiresPhpExtension('bcmath')]
    #[TestDox('Transformation BcMath toArray')]
    public function testTransformationBcMathToArray(): void
    {
        // Arrange
        $expected = [
            'price' => '12.34',
        ];

        // Act
        $bookData = new BcMathBookData()
            ->fromArray($expected);

        $actual = $bookData->toArray();

        // Assert
        $this->assertSame($expected, $actual);
    }
}
