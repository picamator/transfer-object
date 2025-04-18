<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class ArdNewsTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 5;

    protected const array META_DATA = [
        self::NEW_STORIES_COUNT_LINK => self::NEW_STORIES_COUNT_LINK_DATA_NAME,
        self::NEWS => self::NEWS_DATA_NAME,
        self::NEXT_PAGE => self::NEXT_PAGE_DATA_NAME,
        self::REGIONAL => self::REGIONAL_DATA_NAME,
        self::TYPE => self::TYPE_DATA_NAME,
    ];

    // newStoriesCountLink
    public const string NEW_STORIES_COUNT_LINK = 'newStoriesCountLink';
    protected const string NEW_STORIES_COUNT_LINK_DATA_NAME = 'NEW_STORIES_COUNT_LINK';
    protected const int NEW_STORIES_COUNT_LINK_DATA_INDEX = 0;

    public ?string $newStoriesCountLink {
        get => $this->getData(self::NEW_STORIES_COUNT_LINK_DATA_INDEX, false);
        set => $this->setData(self::NEW_STORIES_COUNT_LINK_DATA_INDEX, $value);
    }

    // news
    #[CollectionPropertyTypeAttribute(NewsTransfer::class)]
    public const string NEWS = 'news';
    protected const string NEWS_DATA_NAME = 'NEWS';
    protected const int NEWS_DATA_INDEX = 1;

    /** @var \ArrayObject<int,NewsTransfer> */
    public ArrayObject $news {
        get => $this->getData(self::NEWS_DATA_INDEX, true);
        set => $this->setData(self::NEWS_DATA_INDEX, $value);
    }

    // nextPage
    public const string NEXT_PAGE = 'nextPage';
    protected const string NEXT_PAGE_DATA_NAME = 'NEXT_PAGE';
    protected const int NEXT_PAGE_DATA_INDEX = 2;

    public ?string $nextPage {
        get => $this->getData(self::NEXT_PAGE_DATA_INDEX, false);
        set => $this->setData(self::NEXT_PAGE_DATA_INDEX, $value);
    }

    // regional
    #[ArrayPropertyTypeAttribute]
    public const string REGIONAL = 'regional';
    protected const string REGIONAL_DATA_NAME = 'REGIONAL';
    protected const int REGIONAL_DATA_INDEX = 3;

    /** @var array<int|string,mixed> */
    public array $regional {
        get => $this->getData(self::REGIONAL_DATA_INDEX, true);
        set => $this->setData(self::REGIONAL_DATA_INDEX, $value);
    }

    // type
    public const string TYPE = 'type';
    protected const string TYPE_DATA_NAME = 'TYPE';
    protected const int TYPE_DATA_INDEX = 4;

    public ?string $type {
        get => $this->getData(self::TYPE_DATA_INDEX, false);
        set => $this->setData(self::TYPE_DATA_INDEX, $value);
    }
}
