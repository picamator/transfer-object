<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class NewsTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 19;

    protected const array META_DATA = [
        self::BREAKING_NEWS => self::BREAKING_NEWS_DATA_NAME,
        self::DATE => self::DATE_DATA_NAME,
        self::DETAILS => self::DETAILS_DATA_NAME,
        self::DETAILSWEB => self::DETAILSWEB_DATA_NAME,
        self::EXTERNAL_ID => self::EXTERNAL_ID_DATA_NAME,
        self::FIRST_SENTENCE => self::FIRST_SENTENCE_DATA_NAME,
        self::GEOTAGS => self::GEOTAGS_DATA_NAME,
        self::REGION_ID => self::REGION_ID_DATA_NAME,
        self::REGION_IDS => self::REGION_IDS_DATA_NAME,
        self::RESSORT => self::RESSORT_DATA_NAME,
        self::SHARE_U_R_L => self::SHARE_U_R_L_DATA_NAME,
        self::SOPHORA_ID => self::SOPHORA_ID_DATA_NAME,
        self::TAGS => self::TAGS_DATA_NAME,
        self::TEASER_IMAGE => self::TEASER_IMAGE_DATA_NAME,
        self::TITLE => self::TITLE_DATA_NAME,
        self::TOPLINE => self::TOPLINE_DATA_NAME,
        self::TRACKING => self::TRACKING_DATA_NAME,
        self::TYPE => self::TYPE_DATA_NAME,
        self::UPDATE_CHECK_URL => self::UPDATE_CHECK_URL_DATA_NAME,
    ];

    // breakingNews
    public const string BREAKING_NEWS = 'breakingNews';
    protected const string BREAKING_NEWS_DATA_NAME = 'BREAKING_NEWS';
    protected const int BREAKING_NEWS_DATA_INDEX = 0;

    public ?bool $breakingNews {
        get => $this->getData(self::BREAKING_NEWS_DATA_INDEX);
        set => $this->setData(self::BREAKING_NEWS_DATA_INDEX, $value);
    }

    // date
    public const string DATE = 'date';
    protected const string DATE_DATA_NAME = 'DATE';
    protected const int DATE_DATA_INDEX = 1;

    public ?string $date {
        get => $this->getData(self::DATE_DATA_INDEX);
        set => $this->setData(self::DATE_DATA_INDEX, $value);
    }

    // details
    public const string DETAILS = 'details';
    protected const string DETAILS_DATA_NAME = 'DETAILS';
    protected const int DETAILS_DATA_INDEX = 2;

    public ?string $details {
        get => $this->getData(self::DETAILS_DATA_INDEX);
        set => $this->setData(self::DETAILS_DATA_INDEX, $value);
    }

    // detailsweb
    public const string DETAILSWEB = 'detailsweb';
    protected const string DETAILSWEB_DATA_NAME = 'DETAILSWEB';
    protected const int DETAILSWEB_DATA_INDEX = 3;

    public ?string $detailsweb {
        get => $this->getData(self::DETAILSWEB_DATA_INDEX);
        set => $this->setData(self::DETAILSWEB_DATA_INDEX, $value);
    }

    // externalId
    public const string EXTERNAL_ID = 'externalId';
    protected const string EXTERNAL_ID_DATA_NAME = 'EXTERNAL_ID';
    protected const int EXTERNAL_ID_DATA_INDEX = 4;

    public ?string $externalId {
        get => $this->getData(self::EXTERNAL_ID_DATA_INDEX);
        set => $this->setData(self::EXTERNAL_ID_DATA_INDEX, $value);
    }

    // firstSentence
    public const string FIRST_SENTENCE = 'firstSentence';
    protected const string FIRST_SENTENCE_DATA_NAME = 'FIRST_SENTENCE';
    protected const int FIRST_SENTENCE_DATA_INDEX = 5;

    public ?string $firstSentence {
        get => $this->getData(self::FIRST_SENTENCE_DATA_INDEX);
        set => $this->setData(self::FIRST_SENTENCE_DATA_INDEX, $value);
    }

    // geotags
    #[ArrayPropertyTypeAttribute]
    public const string GEOTAGS = 'geotags';
    protected const string GEOTAGS_DATA_NAME = 'GEOTAGS';
    protected const int GEOTAGS_DATA_INDEX = 6;

    /** @var array<int|string,mixed> */
    public array $geotags {
        get => $this->getRequiredData(self::GEOTAGS_DATA_INDEX);
        set => $this->setData(self::GEOTAGS_DATA_INDEX, $value);
    }

    // regionId
    public const string REGION_ID = 'regionId';
    protected const string REGION_ID_DATA_NAME = 'REGION_ID';
    protected const int REGION_ID_DATA_INDEX = 7;

    public ?int $regionId {
        get => $this->getData(self::REGION_ID_DATA_INDEX);
        set => $this->setData(self::REGION_ID_DATA_INDEX, $value);
    }

    // regionIds
    #[ArrayPropertyTypeAttribute]
    public const string REGION_IDS = 'regionIds';
    protected const string REGION_IDS_DATA_NAME = 'REGION_IDS';
    protected const int REGION_IDS_DATA_INDEX = 8;

    /** @var array<int|string,mixed> */
    public array $regionIds {
        get => $this->getRequiredData(self::REGION_IDS_DATA_INDEX);
        set => $this->setData(self::REGION_IDS_DATA_INDEX, $value);
    }

    // ressort
    public const string RESSORT = 'ressort';
    protected const string RESSORT_DATA_NAME = 'RESSORT';
    protected const int RESSORT_DATA_INDEX = 9;

    public ?string $ressort {
        get => $this->getData(self::RESSORT_DATA_INDEX);
        set => $this->setData(self::RESSORT_DATA_INDEX, $value);
    }

    // shareURL
    public const string SHARE_U_R_L = 'shareURL';
    protected const string SHARE_U_R_L_DATA_NAME = 'SHARE_U_R_L';
    protected const int SHARE_U_R_L_DATA_INDEX = 10;

    public ?string $shareURL {
        get => $this->getData(self::SHARE_U_R_L_DATA_INDEX);
        set => $this->setData(self::SHARE_U_R_L_DATA_INDEX, $value);
    }

    // sophoraId
    public const string SOPHORA_ID = 'sophoraId';
    protected const string SOPHORA_ID_DATA_NAME = 'SOPHORA_ID';
    protected const int SOPHORA_ID_DATA_INDEX = 11;

    public ?string $sophoraId {
        get => $this->getData(self::SOPHORA_ID_DATA_INDEX);
        set => $this->setData(self::SOPHORA_ID_DATA_INDEX, $value);
    }

    // tags
    #[CollectionPropertyTypeAttribute(TagsTransfer::class)]
    public const string TAGS = 'tags';
    protected const string TAGS_DATA_NAME = 'TAGS';
    protected const int TAGS_DATA_INDEX = 12;

    /** @var \ArrayObject<int,TagsTransfer> */
    public ArrayObject $tags {
        get => $this->getRequiredData(self::TAGS_DATA_INDEX);
        set => $this->setData(self::TAGS_DATA_INDEX, $value);
    }

    // teaserImage
    #[PropertyTypeAttribute(TeaserImageTransfer::class)]
    public const string TEASER_IMAGE = 'teaserImage';
    protected const string TEASER_IMAGE_DATA_NAME = 'TEASER_IMAGE';
    protected const int TEASER_IMAGE_DATA_INDEX = 13;

    public ?TeaserImageTransfer $teaserImage {
        get => $this->getData(self::TEASER_IMAGE_DATA_INDEX);
        set => $this->setData(self::TEASER_IMAGE_DATA_INDEX, $value);
    }

    // title
    public const string TITLE = 'title';
    protected const string TITLE_DATA_NAME = 'TITLE';
    protected const int TITLE_DATA_INDEX = 14;

    public ?string $title {
        get => $this->getData(self::TITLE_DATA_INDEX);
        set => $this->setData(self::TITLE_DATA_INDEX, $value);
    }

    // topline
    public const string TOPLINE = 'topline';
    protected const string TOPLINE_DATA_NAME = 'TOPLINE';
    protected const int TOPLINE_DATA_INDEX = 15;

    public ?string $topline {
        get => $this->getData(self::TOPLINE_DATA_INDEX);
        set => $this->setData(self::TOPLINE_DATA_INDEX, $value);
    }

    // tracking
    #[CollectionPropertyTypeAttribute(TrackingTransfer::class)]
    public const string TRACKING = 'tracking';
    protected const string TRACKING_DATA_NAME = 'TRACKING';
    protected const int TRACKING_DATA_INDEX = 16;

    /** @var \ArrayObject<int,TrackingTransfer> */
    public ArrayObject $tracking {
        get => $this->getRequiredData(self::TRACKING_DATA_INDEX);
        set => $this->setData(self::TRACKING_DATA_INDEX, $value);
    }

    // type
    public const string TYPE = 'type';
    protected const string TYPE_DATA_NAME = 'TYPE';
    protected const int TYPE_DATA_INDEX = 17;

    public ?string $type {
        get => $this->getData(self::TYPE_DATA_INDEX);
        set => $this->setData(self::TYPE_DATA_INDEX, $value);
    }

    // updateCheckUrl
    public const string UPDATE_CHECK_URL = 'updateCheckUrl';
    protected const string UPDATE_CHECK_URL_DATA_NAME = 'UPDATE_CHECK_URL';
    protected const int UPDATE_CHECK_URL_DATA_INDEX = 18;

    public ?string $updateCheckUrl {
        get => $this->getData(self::UPDATE_CHECK_URL_DATA_INDEX);
        set => $this->setData(self::UPDATE_CHECK_URL_DATA_INDEX, $value);
    }
}
