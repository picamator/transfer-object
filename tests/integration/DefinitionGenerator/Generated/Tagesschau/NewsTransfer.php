<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Tagesschau;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
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
        self::BRANDING_IMAGE_PROP => self::BRANDING_IMAGE_INDEX,
        self::BREAKING_NEWS_PROP => self::BREAKING_NEWS_INDEX,
        self::COMMENTS_PROP => self::COMMENTS_INDEX,
        self::DATE_PROP => self::DATE_INDEX,
        self::DETAILS_PROP => self::DETAILS_INDEX,
        self::DETAILSWEB_PROP => self::DETAILSWEB_INDEX,
        self::EXTERNAL_ID_PROP => self::EXTERNAL_ID_INDEX,
        self::FIRST_SENTENCE_PROP => self::FIRST_SENTENCE_INDEX,
        self::GEOTAGS_PROP => self::GEOTAGS_INDEX,
        self::REGION_ID_PROP => self::REGION_ID_INDEX,
        self::REGION_IDS_PROP => self::REGION_IDS_INDEX,
        self::RESSORT_PROP => self::RESSORT_INDEX,
        self::SHARE_U_R_L_PROP => self::SHARE_U_R_L_INDEX,
        self::SOPHORA_ID_PROP => self::SOPHORA_ID_INDEX,
        self::TAGS_PROP => self::TAGS_INDEX,
        self::TEASER_IMAGE_PROP => self::TEASER_IMAGE_INDEX,
        self::TITLE_PROP => self::TITLE_INDEX,
        self::TOPLINE_PROP => self::TOPLINE_INDEX,
        self::TRACKING_PROP => self::TRACKING_INDEX,
        self::TYPE_PROP => self::TYPE_INDEX,
        self::UPDATE_CHECK_URL_PROP => self::UPDATE_CHECK_URL_INDEX,
    ];

    // brandingImage
    #[TransferTransformerAttribute(BrandingImageTransfer::class)]
    public const string BRANDING_IMAGE_PROP = 'brandingImage';
    private const int BRANDING_IMAGE_INDEX = 0;

    public ?BrandingImageTransfer $brandingImage {
        get => $this->getData(self::BRANDING_IMAGE_INDEX);
        set => $this->setData(self::BRANDING_IMAGE_INDEX, $value);
    }

    // breakingNews
    public const string BREAKING_NEWS_PROP = 'breakingNews';
    private const int BREAKING_NEWS_INDEX = 1;

    public ?bool $breakingNews {
        get => $this->getData(self::BREAKING_NEWS_INDEX);
        set => $this->setData(self::BREAKING_NEWS_INDEX, $value);
    }

    // comments
    public const string COMMENTS_PROP = 'comments';
    private const int COMMENTS_INDEX = 2;

    public ?string $comments {
        get => $this->getData(self::COMMENTS_INDEX);
        set => $this->setData(self::COMMENTS_INDEX, $value);
    }

    // date
    public const string DATE_PROP = 'date';
    private const int DATE_INDEX = 3;

    public ?string $date {
        get => $this->getData(self::DATE_INDEX);
        set => $this->setData(self::DATE_INDEX, $value);
    }

    // details
    public const string DETAILS_PROP = 'details';
    private const int DETAILS_INDEX = 4;

    public ?string $details {
        get => $this->getData(self::DETAILS_INDEX);
        set => $this->setData(self::DETAILS_INDEX, $value);
    }

    // detailsweb
    public const string DETAILSWEB_PROP = 'detailsweb';
    private const int DETAILSWEB_INDEX = 5;

    public ?string $detailsweb {
        get => $this->getData(self::DETAILSWEB_INDEX);
        set => $this->setData(self::DETAILSWEB_INDEX, $value);
    }

    // externalId
    public const string EXTERNAL_ID_PROP = 'externalId';
    private const int EXTERNAL_ID_INDEX = 6;

    public ?string $externalId {
        get => $this->getData(self::EXTERNAL_ID_INDEX);
        set => $this->setData(self::EXTERNAL_ID_INDEX, $value);
    }

    // firstSentence
    public const string FIRST_SENTENCE_PROP = 'firstSentence';
    private const int FIRST_SENTENCE_INDEX = 7;

    public ?string $firstSentence {
        get => $this->getData(self::FIRST_SENTENCE_INDEX);
        set => $this->setData(self::FIRST_SENTENCE_INDEX, $value);
    }

    // geotags
    #[ArrayInitiatorAttribute]
    public const string GEOTAGS_PROP = 'geotags';
    private const int GEOTAGS_INDEX = 8;

    /** @var array<int|string,mixed> */
    public array $geotags {
        get => $this->getData(self::GEOTAGS_INDEX);
        set => $this->setData(self::GEOTAGS_INDEX, $value);
    }

    // regionId
    public const string REGION_ID_PROP = 'regionId';
    private const int REGION_ID_INDEX = 9;

    public ?int $regionId {
        get => $this->getData(self::REGION_ID_INDEX);
        set => $this->setData(self::REGION_ID_INDEX, $value);
    }

    // regionIds
    #[ArrayInitiatorAttribute]
    public const string REGION_IDS_PROP = 'regionIds';
    private const int REGION_IDS_INDEX = 10;

    /** @var array<int|string,mixed> */
    public array $regionIds {
        get => $this->getData(self::REGION_IDS_INDEX);
        set => $this->setData(self::REGION_IDS_INDEX, $value);
    }

    // ressort
    public const string RESSORT_PROP = 'ressort';
    private const int RESSORT_INDEX = 11;

    public ?string $ressort {
        get => $this->getData(self::RESSORT_INDEX);
        set => $this->setData(self::RESSORT_INDEX, $value);
    }

    // shareURL
    public const string SHARE_U_R_L_PROP = 'shareURL';
    private const int SHARE_U_R_L_INDEX = 12;

    public ?string $shareURL {
        get => $this->getData(self::SHARE_U_R_L_INDEX);
        set => $this->setData(self::SHARE_U_R_L_INDEX, $value);
    }

    // sophoraId
    public const string SOPHORA_ID_PROP = 'sophoraId';
    private const int SOPHORA_ID_INDEX = 13;

    public ?string $sophoraId {
        get => $this->getData(self::SOPHORA_ID_INDEX);
        set => $this->setData(self::SOPHORA_ID_INDEX, $value);
    }

    // tags
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(TagsTransfer::class)]
    public const string TAGS_PROP = 'tags';
    private const int TAGS_INDEX = 14;

    /** @var \ArrayObject<int,TagsTransfer> */
    public ArrayObject $tags {
        get => $this->getData(self::TAGS_INDEX);
        set => $this->setData(self::TAGS_INDEX, $value);
    }

    // teaserImage
    #[TransferTransformerAttribute(TeaserImageTransfer::class)]
    public const string TEASER_IMAGE_PROP = 'teaserImage';
    private const int TEASER_IMAGE_INDEX = 15;

    public ?TeaserImageTransfer $teaserImage {
        get => $this->getData(self::TEASER_IMAGE_INDEX);
        set => $this->setData(self::TEASER_IMAGE_INDEX, $value);
    }

    // title
    public const string TITLE_PROP = 'title';
    private const int TITLE_INDEX = 16;

    public ?string $title {
        get => $this->getData(self::TITLE_INDEX);
        set => $this->setData(self::TITLE_INDEX, $value);
    }

    // topline
    public const string TOPLINE_PROP = 'topline';
    private const int TOPLINE_INDEX = 17;

    public ?string $topline {
        get => $this->getData(self::TOPLINE_INDEX);
        set => $this->setData(self::TOPLINE_INDEX, $value);
    }

    // tracking
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(TrackingTransfer::class)]
    public const string TRACKING_PROP = 'tracking';
    private const int TRACKING_INDEX = 18;

    /** @var \ArrayObject<int,TrackingTransfer> */
    public ArrayObject $tracking {
        get => $this->getData(self::TRACKING_INDEX);
        set => $this->setData(self::TRACKING_INDEX, $value);
    }

    // type
    public const string TYPE_PROP = 'type';
    private const int TYPE_INDEX = 19;

    public ?string $type {
        get => $this->getData(self::TYPE_INDEX);
        set => $this->setData(self::TYPE_INDEX, $value);
    }

    // updateCheckUrl
    public const string UPDATE_CHECK_URL_PROP = 'updateCheckUrl';
    private const int UPDATE_CHECK_URL_INDEX = 20;

    public ?string $updateCheckUrl {
        get => $this->getData(self::UPDATE_CHECK_URL_INDEX);
        set => $this->setData(self::UPDATE_CHECK_URL_INDEX, $value);
    }
}
