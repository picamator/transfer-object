<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\GoogleShoppingContent;

use DateTime;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\DateTimeTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/google-shopping-content/definition/product.transfer.yml Definition file path.
 */
final class ProductTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 25;

    protected const array META_DATA = [
        self::AGE_GROUP => self::AGE_GROUP_INDEX,
        self::AVAILABILITY => self::AVAILABILITY_INDEX,
        self::AVAILABILITY_DATE => self::AVAILABILITY_DATE_INDEX,
        self::BRAND => self::BRAND_INDEX,
        self::CHANNEL => self::CHANNEL_INDEX,
        self::COLOR => self::COLOR_INDEX,
        self::CONDITION => self::CONDITION_INDEX,
        self::CONTENT_LANGUAGE => self::CONTENT_LANGUAGE_INDEX,
        self::DESCRIPTION => self::DESCRIPTION_INDEX,
        self::FEED_LABEL => self::FEED_LABEL_INDEX,
        self::GENDER => self::GENDER_INDEX,
        self::GOOGLE_PRODUCT_CATEGORY => self::GOOGLE_PRODUCT_CATEGORY_INDEX,
        self::GTIN => self::GTIN_INDEX,
        self::ID => self::ID_INDEX,
        self::IMAGE_LINK => self::IMAGE_LINK_INDEX,
        self::ITEM_GROUP_ID => self::ITEM_GROUP_ID_INDEX,
        self::KIND => self::KIND_INDEX,
        self::LINK => self::LINK_INDEX,
        self::MPN => self::MPN_INDEX,
        self::OFFER_ID => self::OFFER_ID_INDEX,
        self::PRICE => self::PRICE_INDEX,
        self::SIZES => self::SIZES_INDEX,
        self::SOURCE => self::SOURCE_INDEX,
        self::TARGET_COUNTRY => self::TARGET_COUNTRY_INDEX,
        self::TITLE => self::TITLE_INDEX,
    ];

    // ageGroup
    public const string AGE_GROUP = 'ageGroup';
    private const int AGE_GROUP_INDEX = 0;

    public ?string $ageGroup {
        get => $this->getData(self::AGE_GROUP_INDEX);
        set => $this->setData(self::AGE_GROUP_INDEX, $value);
    }

    // availability
    public const string AVAILABILITY = 'availability';
    private const int AVAILABILITY_INDEX = 1;

    public ?string $availability {
        get => $this->getData(self::AVAILABILITY_INDEX);
        set => $this->setData(self::AVAILABILITY_INDEX, $value);
    }

    // availabilityDate
    #[DateTimeTransformerAttribute(DateTime::class)]
    public const string AVAILABILITY_DATE = 'availabilityDate';
    private const int AVAILABILITY_DATE_INDEX = 2;

    public ?DateTime $availabilityDate {
        get => $this->getData(self::AVAILABILITY_DATE_INDEX);
        set => $this->setData(self::AVAILABILITY_DATE_INDEX, $value);
    }

    // brand
    public const string BRAND = 'brand';
    private const int BRAND_INDEX = 3;

    public ?string $brand {
        get => $this->getData(self::BRAND_INDEX);
        set => $this->setData(self::BRAND_INDEX, $value);
    }

    // channel
    public const string CHANNEL = 'channel';
    private const int CHANNEL_INDEX = 4;

    public ?string $channel {
        get => $this->getData(self::CHANNEL_INDEX);
        set => $this->setData(self::CHANNEL_INDEX, $value);
    }

    // color
    public const string COLOR = 'color';
    private const int COLOR_INDEX = 5;

    public ?string $color {
        get => $this->getData(self::COLOR_INDEX);
        set => $this->setData(self::COLOR_INDEX, $value);
    }

    // condition
    public const string CONDITION = 'condition';
    private const int CONDITION_INDEX = 6;

    public ?string $condition {
        get => $this->getData(self::CONDITION_INDEX);
        set => $this->setData(self::CONDITION_INDEX, $value);
    }

    // contentLanguage
    public const string CONTENT_LANGUAGE = 'contentLanguage';
    private const int CONTENT_LANGUAGE_INDEX = 7;

    public ?string $contentLanguage {
        get => $this->getData(self::CONTENT_LANGUAGE_INDEX);
        set => $this->setData(self::CONTENT_LANGUAGE_INDEX, $value);
    }

    // description
    public const string DESCRIPTION = 'description';
    private const int DESCRIPTION_INDEX = 8;

    public ?string $description {
        get => $this->getData(self::DESCRIPTION_INDEX);
        set => $this->setData(self::DESCRIPTION_INDEX, $value);
    }

    // feedLabel
    public const string FEED_LABEL = 'feedLabel';
    private const int FEED_LABEL_INDEX = 9;

    public ?string $feedLabel {
        get => $this->getData(self::FEED_LABEL_INDEX);
        set => $this->setData(self::FEED_LABEL_INDEX, $value);
    }

    // gender
    public const string GENDER = 'gender';
    private const int GENDER_INDEX = 10;

    public ?string $gender {
        get => $this->getData(self::GENDER_INDEX);
        set => $this->setData(self::GENDER_INDEX, $value);
    }

    // googleProductCategory
    public const string GOOGLE_PRODUCT_CATEGORY = 'googleProductCategory';
    private const int GOOGLE_PRODUCT_CATEGORY_INDEX = 11;

    public ?string $googleProductCategory {
        get => $this->getData(self::GOOGLE_PRODUCT_CATEGORY_INDEX);
        set => $this->setData(self::GOOGLE_PRODUCT_CATEGORY_INDEX, $value);
    }

    // gtin
    public const string GTIN = 'gtin';
    private const int GTIN_INDEX = 12;

    public ?string $gtin {
        get => $this->getData(self::GTIN_INDEX);
        set => $this->setData(self::GTIN_INDEX, $value);
    }

    // id
    public const string ID = 'id';
    private const int ID_INDEX = 13;

    public ?string $id {
        get => $this->getData(self::ID_INDEX);
        set => $this->setData(self::ID_INDEX, $value);
    }

    // imageLink
    public const string IMAGE_LINK = 'imageLink';
    private const int IMAGE_LINK_INDEX = 14;

    public ?string $imageLink {
        get => $this->getData(self::IMAGE_LINK_INDEX);
        set => $this->setData(self::IMAGE_LINK_INDEX, $value);
    }

    // itemGroupId
    public const string ITEM_GROUP_ID = 'itemGroupId';
    private const int ITEM_GROUP_ID_INDEX = 15;

    public ?string $itemGroupId {
        get => $this->getData(self::ITEM_GROUP_ID_INDEX);
        set => $this->setData(self::ITEM_GROUP_ID_INDEX, $value);
    }

    // kind
    public const string KIND = 'kind';
    private const int KIND_INDEX = 16;

    public ?string $kind {
        get => $this->getData(self::KIND_INDEX);
        set => $this->setData(self::KIND_INDEX, $value);
    }

    // link
    public const string LINK = 'link';
    private const int LINK_INDEX = 17;

    public ?string $link {
        get => $this->getData(self::LINK_INDEX);
        set => $this->setData(self::LINK_INDEX, $value);
    }

    // mpn
    public const string MPN = 'mpn';
    private const int MPN_INDEX = 18;

    public ?string $mpn {
        get => $this->getData(self::MPN_INDEX);
        set => $this->setData(self::MPN_INDEX, $value);
    }

    // offerId
    public const string OFFER_ID = 'offerId';
    private const int OFFER_ID_INDEX = 19;

    public ?string $offerId {
        get => $this->getData(self::OFFER_ID_INDEX);
        set => $this->setData(self::OFFER_ID_INDEX, $value);
    }

    // price
    #[TransferTransformerAttribute(PriceTransfer::class)]
    public const string PRICE = 'price';
    private const int PRICE_INDEX = 20;

    public ?PriceTransfer $price {
        get => $this->getData(self::PRICE_INDEX);
        set => $this->setData(self::PRICE_INDEX, $value);
    }

    // sizes
    #[ArrayInitiatorAttribute]
    public const string SIZES = 'sizes';
    private const int SIZES_INDEX = 21;

    /** @var array<int|string,mixed> */
    public array $sizes {
        get => $this->getData(self::SIZES_INDEX);
        set => $this->setData(self::SIZES_INDEX, $value);
    }

    // source
    public const string SOURCE = 'source';
    private const int SOURCE_INDEX = 22;

    public ?string $source {
        get => $this->getData(self::SOURCE_INDEX);
        set => $this->setData(self::SOURCE_INDEX, $value);
    }

    // targetCountry
    public const string TARGET_COUNTRY = 'targetCountry';
    private const int TARGET_COUNTRY_INDEX = 23;

    public ?string $targetCountry {
        get => $this->getData(self::TARGET_COUNTRY_INDEX);
        set => $this->setData(self::TARGET_COUNTRY_INDEX, $value);
    }

    // title
    public const string TITLE = 'title';
    private const int TITLE_INDEX = 24;

    public ?string $title {
        get => $this->getData(self::TITLE_INDEX);
        set => $this->setData(self::TITLE_INDEX, $value);
    }
}
