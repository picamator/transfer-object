<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\GoogleShoppingContent;

use DateTime;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\DateTimePropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

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
        self::AGE_GROUP_INDEX => self::AGE_GROUP,
        self::AVAILABILITY_INDEX => self::AVAILABILITY,
        self::AVAILABILITY_DATE_INDEX => self::AVAILABILITY_DATE,
        self::BRAND_INDEX => self::BRAND,
        self::CHANNEL_INDEX => self::CHANNEL,
        self::COLOR_INDEX => self::COLOR,
        self::CONDITION_INDEX => self::CONDITION,
        self::CONTENT_LANGUAGE_INDEX => self::CONTENT_LANGUAGE,
        self::DESCRIPTION_INDEX => self::DESCRIPTION,
        self::FEED_LABEL_INDEX => self::FEED_LABEL,
        self::GENDER_INDEX => self::GENDER,
        self::GOOGLE_PRODUCT_CATEGORY_INDEX => self::GOOGLE_PRODUCT_CATEGORY,
        self::GTIN_INDEX => self::GTIN,
        self::ID_INDEX => self::ID,
        self::IMAGE_LINK_INDEX => self::IMAGE_LINK,
        self::ITEM_GROUP_ID_INDEX => self::ITEM_GROUP_ID,
        self::KIND_INDEX => self::KIND,
        self::LINK_INDEX => self::LINK,
        self::MPN_INDEX => self::MPN,
        self::OFFER_ID_INDEX => self::OFFER_ID,
        self::PRICE_INDEX => self::PRICE,
        self::SIZES_INDEX => self::SIZES,
        self::SOURCE_INDEX => self::SOURCE,
        self::TARGET_COUNTRY_INDEX => self::TARGET_COUNTRY,
        self::TITLE_INDEX => self::TITLE,
    ];

    // ageGroup
    public const string AGE_GROUP = 'ageGroup';
    protected const int AGE_GROUP_INDEX = 0;

    public ?string $ageGroup {
        get => $this->getData(self::AGE_GROUP_INDEX);
        set => $this->setData(self::AGE_GROUP_INDEX, $value);
    }

    // availability
    public const string AVAILABILITY = 'availability';
    protected const int AVAILABILITY_INDEX = 1;

    public ?string $availability {
        get => $this->getData(self::AVAILABILITY_INDEX);
        set => $this->setData(self::AVAILABILITY_INDEX, $value);
    }

    // availabilityDate
    #[DateTimePropertyTypeAttribute(DateTime::class)]
    public const string AVAILABILITY_DATE = 'availabilityDate';
    protected const int AVAILABILITY_DATE_INDEX = 2;

    public ?DateTime $availabilityDate {
        get => $this->getData(self::AVAILABILITY_DATE_INDEX);
        set => $this->setData(self::AVAILABILITY_DATE_INDEX, $value);
    }

    // brand
    public const string BRAND = 'brand';
    protected const int BRAND_INDEX = 3;

    public ?string $brand {
        get => $this->getData(self::BRAND_INDEX);
        set => $this->setData(self::BRAND_INDEX, $value);
    }

    // channel
    public const string CHANNEL = 'channel';
    protected const int CHANNEL_INDEX = 4;

    public ?string $channel {
        get => $this->getData(self::CHANNEL_INDEX);
        set => $this->setData(self::CHANNEL_INDEX, $value);
    }

    // color
    public const string COLOR = 'color';
    protected const int COLOR_INDEX = 5;

    public ?string $color {
        get => $this->getData(self::COLOR_INDEX);
        set => $this->setData(self::COLOR_INDEX, $value);
    }

    // condition
    public const string CONDITION = 'condition';
    protected const int CONDITION_INDEX = 6;

    public ?string $condition {
        get => $this->getData(self::CONDITION_INDEX);
        set => $this->setData(self::CONDITION_INDEX, $value);
    }

    // contentLanguage
    public const string CONTENT_LANGUAGE = 'contentLanguage';
    protected const int CONTENT_LANGUAGE_INDEX = 7;

    public ?string $contentLanguage {
        get => $this->getData(self::CONTENT_LANGUAGE_INDEX);
        set => $this->setData(self::CONTENT_LANGUAGE_INDEX, $value);
    }

    // description
    public const string DESCRIPTION = 'description';
    protected const int DESCRIPTION_INDEX = 8;

    public ?string $description {
        get => $this->getData(self::DESCRIPTION_INDEX);
        set => $this->setData(self::DESCRIPTION_INDEX, $value);
    }

    // feedLabel
    public const string FEED_LABEL = 'feedLabel';
    protected const int FEED_LABEL_INDEX = 9;

    public ?string $feedLabel {
        get => $this->getData(self::FEED_LABEL_INDEX);
        set => $this->setData(self::FEED_LABEL_INDEX, $value);
    }

    // gender
    public const string GENDER = 'gender';
    protected const int GENDER_INDEX = 10;

    public ?string $gender {
        get => $this->getData(self::GENDER_INDEX);
        set => $this->setData(self::GENDER_INDEX, $value);
    }

    // googleProductCategory
    public const string GOOGLE_PRODUCT_CATEGORY = 'googleProductCategory';
    protected const int GOOGLE_PRODUCT_CATEGORY_INDEX = 11;

    public ?string $googleProductCategory {
        get => $this->getData(self::GOOGLE_PRODUCT_CATEGORY_INDEX);
        set => $this->setData(self::GOOGLE_PRODUCT_CATEGORY_INDEX, $value);
    }

    // gtin
    public const string GTIN = 'gtin';
    protected const int GTIN_INDEX = 12;

    public ?string $gtin {
        get => $this->getData(self::GTIN_INDEX);
        set => $this->setData(self::GTIN_INDEX, $value);
    }

    // id
    public const string ID = 'id';
    protected const int ID_INDEX = 13;

    public ?string $id {
        get => $this->getData(self::ID_INDEX);
        set => $this->setData(self::ID_INDEX, $value);
    }

    // imageLink
    public const string IMAGE_LINK = 'imageLink';
    protected const int IMAGE_LINK_INDEX = 14;

    public ?string $imageLink {
        get => $this->getData(self::IMAGE_LINK_INDEX);
        set => $this->setData(self::IMAGE_LINK_INDEX, $value);
    }

    // itemGroupId
    public const string ITEM_GROUP_ID = 'itemGroupId';
    protected const int ITEM_GROUP_ID_INDEX = 15;

    public ?string $itemGroupId {
        get => $this->getData(self::ITEM_GROUP_ID_INDEX);
        set => $this->setData(self::ITEM_GROUP_ID_INDEX, $value);
    }

    // kind
    public const string KIND = 'kind';
    protected const int KIND_INDEX = 16;

    public ?string $kind {
        get => $this->getData(self::KIND_INDEX);
        set => $this->setData(self::KIND_INDEX, $value);
    }

    // link
    public const string LINK = 'link';
    protected const int LINK_INDEX = 17;

    public ?string $link {
        get => $this->getData(self::LINK_INDEX);
        set => $this->setData(self::LINK_INDEX, $value);
    }

    // mpn
    public const string MPN = 'mpn';
    protected const int MPN_INDEX = 18;

    public ?string $mpn {
        get => $this->getData(self::MPN_INDEX);
        set => $this->setData(self::MPN_INDEX, $value);
    }

    // offerId
    public const string OFFER_ID = 'offerId';
    protected const int OFFER_ID_INDEX = 19;

    public ?string $offerId {
        get => $this->getData(self::OFFER_ID_INDEX);
        set => $this->setData(self::OFFER_ID_INDEX, $value);
    }

    // price
    #[PropertyTypeAttribute(PriceTransfer::class)]
    public const string PRICE = 'price';
    protected const int PRICE_INDEX = 20;

    public ?PriceTransfer $price {
        get => $this->getData(self::PRICE_INDEX);
        set => $this->setData(self::PRICE_INDEX, $value);
    }

    // sizes
    #[ArrayPropertyTypeAttribute]
    public const string SIZES = 'sizes';
    protected const int SIZES_INDEX = 21;

    /** @var array<int|string,mixed> */
    public array $sizes {
        get => $this->getData(self::SIZES_INDEX);
        set => $this->setData(self::SIZES_INDEX, $value);
    }

    // source
    public const string SOURCE = 'source';
    protected const int SOURCE_INDEX = 22;

    public ?string $source {
        get => $this->getData(self::SOURCE_INDEX);
        set => $this->setData(self::SOURCE_INDEX, $value);
    }

    // targetCountry
    public const string TARGET_COUNTRY = 'targetCountry';
    protected const int TARGET_COUNTRY_INDEX = 23;

    public ?string $targetCountry {
        get => $this->getData(self::TARGET_COUNTRY_INDEX);
        set => $this->setData(self::TARGET_COUNTRY_INDEX, $value);
    }

    // title
    public const string TITLE = 'title';
    protected const int TITLE_INDEX = 24;

    public ?string $title {
        get => $this->getData(self::TITLE_INDEX);
        set => $this->setData(self::TITLE_INDEX, $value);
    }
}
