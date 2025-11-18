<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/tagesschau-api-bund-dev-v2/definition/ardNews.transfer.yml Definition file path.
 */
final class ArdNewsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 5;

    protected const array META_DATA = [
        self::NEW_STORIES_COUNT_LINK_PROP => self::NEW_STORIES_COUNT_LINK_INDEX,
        self::NEWS_PROP => self::NEWS_INDEX,
        self::NEXT_PAGE_PROP => self::NEXT_PAGE_INDEX,
        self::REGIONAL_PROP => self::REGIONAL_INDEX,
        self::TYPE_PROP => self::TYPE_INDEX,
    ];

    // newStoriesCountLink
    public const string NEW_STORIES_COUNT_LINK_PROP = 'newStoriesCountLink';
    private const int NEW_STORIES_COUNT_LINK_INDEX = 0;

    public ?string $newStoriesCountLink {
        get => $this->getData(self::NEW_STORIES_COUNT_LINK_INDEX);
        set => $this->setData(self::NEW_STORIES_COUNT_LINK_INDEX, $value);
    }

    // news
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(NewsTransfer::class)]
    public const string NEWS_PROP = 'news';
    private const int NEWS_INDEX = 1;

    /** @var \ArrayObject<int,NewsTransfer> */
    public ArrayObject $news {
        get => $this->getData(self::NEWS_INDEX);
        set => $this->setData(self::NEWS_INDEX, $value);
    }

    // nextPage
    public const string NEXT_PAGE_PROP = 'nextPage';
    private const int NEXT_PAGE_INDEX = 2;

    public ?string $nextPage {
        get => $this->getData(self::NEXT_PAGE_INDEX);
        set => $this->setData(self::NEXT_PAGE_INDEX, $value);
    }

    // regional
    #[ArrayInitiatorAttribute]
    public const string REGIONAL_PROP = 'regional';
    private const int REGIONAL_INDEX = 3;

    /** @var array<int|string,mixed> */
    public array $regional {
        get => $this->getData(self::REGIONAL_INDEX);
        set => $this->setData(self::REGIONAL_INDEX, $value);
    }

    // type
    public const string TYPE_PROP = 'type';
    private const int TYPE_INDEX = 4;

    public ?string $type {
        get => $this->getData(self::TYPE_INDEX);
        set => $this->setData(self::TYPE_INDEX, $value);
    }
}
