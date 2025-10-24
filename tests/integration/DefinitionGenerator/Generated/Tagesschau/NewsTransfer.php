<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Initiator\CollectionInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/tagesschau-api-bund-dev-v2/definition/ardNews.transfer.yml Definition file path.
 */
final class NewsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 21;

    protected const array META_DATA = [
        self::BRANDING_IMAGE_INDEX => self::BRANDING_IMAGE,
        self::BREAKING_NEWS_INDEX => self::BREAKING_NEWS,
        self::COMMENTS_INDEX => self::COMMENTS,
        self::DATE_INDEX => self::DATE,
        self::DETAILS_INDEX => self::DETAILS,
        self::DETAILSWEB_INDEX => self::DETAILSWEB,
        self::EXTERNAL_ID_INDEX => self::EXTERNAL_ID,
        self::FIRST_SENTENCE_INDEX => self::FIRST_SENTENCE,
        self::GEOTAGS_INDEX => self::GEOTAGS,
        self::REGION_ID_INDEX => self::REGION_ID,
        self::REGION_IDS_INDEX => self::REGION_IDS,
        self::RESSORT_INDEX => self::RESSORT,
        self::SHARE_U_R_L_INDEX => self::SHARE_U_R_L,
        self::SOPHORA_ID_INDEX => self::SOPHORA_ID,
        self::TAGS_INDEX => self::TAGS,
        self::TEASER_IMAGE_INDEX => self::TEASER_IMAGE,
        self::TITLE_INDEX => self::TITLE,
        self::TOPLINE_INDEX => self::TOPLINE,
        self::TRACKING_INDEX => self::TRACKING,
        self::TYPE_INDEX => self::TYPE,
        self::UPDATE_CHECK_URL_INDEX => self::UPDATE_CHECK_URL,
    ];

    // brandingImage
    #[TransferTransformerAttribute(BrandingImageTransfer::class)]
    public const string BRANDING_IMAGE = 'brandingImage';
    private const int BRANDING_IMAGE_INDEX = 0;

    public ?BrandingImageTransfer $brandingImage {
        get => $this->getData(self::BRANDING_IMAGE_INDEX);
        set => $this->setData(self::BRANDING_IMAGE_INDEX, $value);
    }

    // breakingNews
    public const string BREAKING_NEWS = 'breakingNews';
    private const int BREAKING_NEWS_INDEX = 1;

    public ?bool $breakingNews {
        get => $this->getData(self::BREAKING_NEWS_INDEX);
        set => $this->setData(self::BREAKING_NEWS_INDEX, $value);
    }

    // comments
    public const string COMMENTS = 'comments';
    private const int COMMENTS_INDEX = 2;

    public ?string $comments {
        get => $this->getData(self::COMMENTS_INDEX);
        set => $this->setData(self::COMMENTS_INDEX, $value);
    }

    // date
    public const string DATE = 'date';
    private const int DATE_INDEX = 3;

    public ?string $date {
        get => $this->getData(self::DATE_INDEX);
        set => $this->setData(self::DATE_INDEX, $value);
    }

    // details
    public const string DETAILS = 'details';
    private const int DETAILS_INDEX = 4;

    public ?string $details {
        get => $this->getData(self::DETAILS_INDEX);
        set => $this->setData(self::DETAILS_INDEX, $value);
    }

    // detailsweb
    public const string DETAILSWEB = 'detailsweb';
    private const int DETAILSWEB_INDEX = 5;

    public ?string $detailsweb {
        get => $this->getData(self::DETAILSWEB_INDEX);
        set => $this->setData(self::DETAILSWEB_INDEX, $value);
    }

    // externalId
    public const string EXTERNAL_ID = 'externalId';
    private const int EXTERNAL_ID_INDEX = 6;

    public ?string $externalId {
        get => $this->getData(self::EXTERNAL_ID_INDEX);
        set => $this->setData(self::EXTERNAL_ID_INDEX, $value);
    }

    // firstSentence
    public const string FIRST_SENTENCE = 'firstSentence';
    private const int FIRST_SENTENCE_INDEX = 7;

    public ?string $firstSentence {
        get => $this->getData(self::FIRST_SENTENCE_INDEX);
        set => $this->setData(self::FIRST_SENTENCE_INDEX, $value);
    }

    // geotags
    #[ArrayInitiatorAttribute]
    public const string GEOTAGS = 'geotags';
    private const int GEOTAGS_INDEX = 8;

    /** @var array<int|string,mixed> */
    public array $geotags {
        get => $this->getData(self::GEOTAGS_INDEX);
        set => $this->setData(self::GEOTAGS_INDEX, $value);
    }

    // regionId
    public const string REGION_ID = 'regionId';
    private const int REGION_ID_INDEX = 9;

    public ?int $regionId {
        get => $this->getData(self::REGION_ID_INDEX);
        set => $this->setData(self::REGION_ID_INDEX, $value);
    }

    // regionIds
    #[ArrayInitiatorAttribute]
    public const string REGION_IDS = 'regionIds';
    private const int REGION_IDS_INDEX = 10;

    /** @var array<int|string,mixed> */
    public array $regionIds {
        get => $this->getData(self::REGION_IDS_INDEX);
        set => $this->setData(self::REGION_IDS_INDEX, $value);
    }

    // ressort
    public const string RESSORT = 'ressort';
    private const int RESSORT_INDEX = 11;

    public ?string $ressort {
        get => $this->getData(self::RESSORT_INDEX);
        set => $this->setData(self::RESSORT_INDEX, $value);
    }

    // shareURL
    public const string SHARE_U_R_L = 'shareURL';
    private const int SHARE_U_R_L_INDEX = 12;

    public ?string $shareURL {
        get => $this->getData(self::SHARE_U_R_L_INDEX);
        set => $this->setData(self::SHARE_U_R_L_INDEX, $value);
    }

    // sophoraId
    public const string SOPHORA_ID = 'sophoraId';
    private const int SOPHORA_ID_INDEX = 13;

    public ?string $sophoraId {
        get => $this->getData(self::SOPHORA_ID_INDEX);
        set => $this->setData(self::SOPHORA_ID_INDEX, $value);
    }

    // tags
    #[CollectionInitiatorAttribute]
    #[CollectionTransformerAttribute(TagsTransfer::class)]
    public const string TAGS = 'tags';
    private const int TAGS_INDEX = 14;

    /** @var \ArrayObject<int,TagsTransfer> */
    public ArrayObject $tags {
        get => $this->getData(self::TAGS_INDEX);
        set => $this->setData(self::TAGS_INDEX, $value);
    }

    // teaserImage
    #[TransferTransformerAttribute(TeaserImageTransfer::class)]
    public const string TEASER_IMAGE = 'teaserImage';
    private const int TEASER_IMAGE_INDEX = 15;

    public ?TeaserImageTransfer $teaserImage {
        get => $this->getData(self::TEASER_IMAGE_INDEX);
        set => $this->setData(self::TEASER_IMAGE_INDEX, $value);
    }

    // title
    public const string TITLE = 'title';
    private const int TITLE_INDEX = 16;

    public ?string $title {
        get => $this->getData(self::TITLE_INDEX);
        set => $this->setData(self::TITLE_INDEX, $value);
    }

    // topline
    public const string TOPLINE = 'topline';
    private const int TOPLINE_INDEX = 17;

    public ?string $topline {
        get => $this->getData(self::TOPLINE_INDEX);
        set => $this->setData(self::TOPLINE_INDEX, $value);
    }

    // tracking
    #[CollectionInitiatorAttribute]
    #[CollectionTransformerAttribute(TrackingTransfer::class)]
    public const string TRACKING = 'tracking';
    private const int TRACKING_INDEX = 18;

    /** @var \ArrayObject<int,TrackingTransfer> */
    public ArrayObject $tracking {
        get => $this->getData(self::TRACKING_INDEX);
        set => $this->setData(self::TRACKING_INDEX, $value);
    }

    // type
    public const string TYPE = 'type';
    private const int TYPE_INDEX = 19;

    public ?string $type {
        get => $this->getData(self::TYPE_INDEX);
        set => $this->setData(self::TYPE_INDEX, $value);
    }

    // updateCheckUrl
    public const string UPDATE_CHECK_URL = 'updateCheckUrl';
    private const int UPDATE_CHECK_URL_INDEX = 20;

    public ?string $updateCheckUrl {
        get => $this->getData(self::UPDATE_CHECK_URL_INDEX);
        set => $this->setData(self::UPDATE_CHECK_URL_INDEX, $value);
    }
}
