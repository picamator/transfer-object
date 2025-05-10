<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Advanced;

use ArrayObject;
use DateTime;
use DateTimeImmutable;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\CountryEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\AuthorTransfer;
use Picamator\TransferObject\Transfer\TransferAdapterTrait;
use Picamator\TransferObject\Transfer\TransferInterface;
use stdClass;

class BookData implements TransferInterface
{
    use TransferAdapterTrait;

    /**
     * @param \ArrayObject<string,mixed>|null $labels
     * @param string|null $reference
     */
    public function __construct(
        public ?string $title = null,
        public ?AuthorTransfer $author = null,
        public ?CountryEnum $country = null,
        public ?BookStoreData $storeData = null,
        public ?ArrayObject $labels = null,
        public ?DateTime $updatedAt = null,
        public ?DateTimeImmutable $createdAt = null,
        public ?stdClass $notes = null,
        public ?int $bookmarkPage = 1,
        public $reference = null,
    ) {
    }
}
