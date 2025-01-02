<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\GoogleShoppingContent;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class ProductTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 25;

    protected const array META_DATA = [
        self::AGE_GROUP => self::AGE_GROUP_DATA_NAME,
        self::AVAILABILITY => self::AVAILABILITY_DATA_NAME,
        self::AVAILABILITY_DATE => self::AVAILABILITY_DATE_DATA_NAME,
        self::BRAND => self::BRAND_DATA_NAME,
        self::CHANNEL => self::CHANNEL_DATA_NAME,
        self::COLOR => self::COLOR_DATA_NAME,
        self::CONDITION => self::CONDITION_DATA_NAME,
        self::CONTENT_LANGUAGE => self::CONTENT_LANGUAGE_DATA_NAME,
        self::DESCRIPTION => self::DESCRIPTION_DATA_NAME,
        self::FEED_LABEL => self::FEED_LABEL_DATA_NAME,
        self::GENDER => self::GENDER_DATA_NAME,
        self::GOOGLE_PRODUCT_CATEGORY => self::GOOGLE_PRODUCT_CATEGORY_DATA_NAME,
        self::GTIN => self::GTIN_DATA_NAME,
        self::ID => self::ID_DATA_NAME,
        self::IMAGE_LINK => self::IMAGE_LINK_DATA_NAME,
        self::ITEM_GROUP_ID => self::ITEM_GROUP_ID_DATA_NAME,
        self::KIND => self::KIND_DATA_NAME,
        self::LINK => self::LINK_DATA_NAME,
        self::MPN => self::MPN_DATA_NAME,
        self::OFFER_ID => self::OFFER_ID_DATA_NAME,
        self::PRICE => self::PRICE_DATA_NAME,
        self::SIZES => self::SIZES_DATA_NAME,
        self::SOURCE => self::SOURCE_DATA_NAME,
        self::TARGET_COUNTRY => self::TARGET_COUNTRY_DATA_NAME,
        self::TITLE => self::TITLE_DATA_NAME,
    ];

    // ageGroup
    public const string AGE_GROUP = 'ageGroup';
    protected const string AGE_GROUP_DATA_NAME = 'AGE_GROUP';
    protected const int AGE_GROUP_DATA_INDEX = 0;

    public ?string $ageGroup {
        get => $this->getData(self::AGE_GROUP_DATA_INDEX);
        set => $this->setData(self::AGE_GROUP_DATA_INDEX, $value);
    }

    // availability
    public const string AVAILABILITY = 'availability';
    protected const string AVAILABILITY_DATA_NAME = 'AVAILABILITY';
    protected const int AVAILABILITY_DATA_INDEX = 1;

    public ?string $availability {
        get => $this->getData(self::AVAILABILITY_DATA_INDEX);
        set => $this->setData(self::AVAILABILITY_DATA_INDEX, $value);
    }

    // availabilityDate
    public const string AVAILABILITY_DATE = 'availabilityDate';
    protected const string AVAILABILITY_DATE_DATA_NAME = 'AVAILABILITY_DATE';
    protected const int AVAILABILITY_DATE_DATA_INDEX = 2;

    public ?string $availabilityDate {
        get => $this->getData(self::AVAILABILITY_DATE_DATA_INDEX);
        set => $this->setData(self::AVAILABILITY_DATE_DATA_INDEX, $value);
    }

    // brand
    public const string BRAND = 'brand';
    protected const string BRAND_DATA_NAME = 'BRAND';
    protected const int BRAND_DATA_INDEX = 3;

    public ?string $brand {
        get => $this->getData(self::BRAND_DATA_INDEX);
        set => $this->setData(self::BRAND_DATA_INDEX, $value);
    }

    // channel
    public const string CHANNEL = 'channel';
    protected const string CHANNEL_DATA_NAME = 'CHANNEL';
    protected const int CHANNEL_DATA_INDEX = 4;

    public ?string $channel {
        get => $this->getData(self::CHANNEL_DATA_INDEX);
        set => $this->setData(self::CHANNEL_DATA_INDEX, $value);
    }

    // color
    public const string COLOR = 'color';
    protected const string COLOR_DATA_NAME = 'COLOR';
    protected const int COLOR_DATA_INDEX = 5;

    public ?string $color {
        get => $this->getData(self::COLOR_DATA_INDEX);
        set => $this->setData(self::COLOR_DATA_INDEX, $value);
    }

    // condition
    public const string CONDITION = 'condition';
    protected const string CONDITION_DATA_NAME = 'CONDITION';
    protected const int CONDITION_DATA_INDEX = 6;

    public ?string $condition {
        get => $this->getData(self::CONDITION_DATA_INDEX);
        set => $this->setData(self::CONDITION_DATA_INDEX, $value);
    }

    // contentLanguage
    public const string CONTENT_LANGUAGE = 'contentLanguage';
    protected const string CONTENT_LANGUAGE_DATA_NAME = 'CONTENT_LANGUAGE';
    protected const int CONTENT_LANGUAGE_DATA_INDEX = 7;

    public ?string $contentLanguage {
        get => $this->getData(self::CONTENT_LANGUAGE_DATA_INDEX);
        set => $this->setData(self::CONTENT_LANGUAGE_DATA_INDEX, $value);
    }

    // description
    public const string DESCRIPTION = 'description';
    protected const string DESCRIPTION_DATA_NAME = 'DESCRIPTION';
    protected const int DESCRIPTION_DATA_INDEX = 8;

    public ?string $description {
        get => $this->getData(self::DESCRIPTION_DATA_INDEX);
        set => $this->setData(self::DESCRIPTION_DATA_INDEX, $value);
    }

    // feedLabel
    public const string FEED_LABEL = 'feedLabel';
    protected const string FEED_LABEL_DATA_NAME = 'FEED_LABEL';
    protected const int FEED_LABEL_DATA_INDEX = 9;

    public ?string $feedLabel {
        get => $this->getData(self::FEED_LABEL_DATA_INDEX);
        set => $this->setData(self::FEED_LABEL_DATA_INDEX, $value);
    }

    // gender
    public const string GENDER = 'gender';
    protected const string GENDER_DATA_NAME = 'GENDER';
    protected const int GENDER_DATA_INDEX = 10;

    public ?string $gender {
        get => $this->getData(self::GENDER_DATA_INDEX);
        set => $this->setData(self::GENDER_DATA_INDEX, $value);
    }

    // googleProductCategory
    public const string GOOGLE_PRODUCT_CATEGORY = 'googleProductCategory';
    protected const string GOOGLE_PRODUCT_CATEGORY_DATA_NAME = 'GOOGLE_PRODUCT_CATEGORY';
    protected const int GOOGLE_PRODUCT_CATEGORY_DATA_INDEX = 11;

    public ?string $googleProductCategory {
        get => $this->getData(self::GOOGLE_PRODUCT_CATEGORY_DATA_INDEX);
        set => $this->setData(self::GOOGLE_PRODUCT_CATEGORY_DATA_INDEX, $value);
    }

    // gtin
    public const string GTIN = 'gtin';
    protected const string GTIN_DATA_NAME = 'GTIN';
    protected const int GTIN_DATA_INDEX = 12;

    public ?string $gtin {
        get => $this->getData(self::GTIN_DATA_INDEX);
        set => $this->setData(self::GTIN_DATA_INDEX, $value);
    }

    // id
    public const string ID = 'id';
    protected const string ID_DATA_NAME = 'ID';
    protected const int ID_DATA_INDEX = 13;

    public ?string $id {
        get => $this->getData(self::ID_DATA_INDEX);
        set => $this->setData(self::ID_DATA_INDEX, $value);
    }

    // imageLink
    public const string IMAGE_LINK = 'imageLink';
    protected const string IMAGE_LINK_DATA_NAME = 'IMAGE_LINK';
    protected const int IMAGE_LINK_DATA_INDEX = 14;

    public ?string $imageLink {
        get => $this->getData(self::IMAGE_LINK_DATA_INDEX);
        set => $this->setData(self::IMAGE_LINK_DATA_INDEX, $value);
    }

    // itemGroupId
    public const string ITEM_GROUP_ID = 'itemGroupId';
    protected const string ITEM_GROUP_ID_DATA_NAME = 'ITEM_GROUP_ID';
    protected const int ITEM_GROUP_ID_DATA_INDEX = 15;

    public ?string $itemGroupId {
        get => $this->getData(self::ITEM_GROUP_ID_DATA_INDEX);
        set => $this->setData(self::ITEM_GROUP_ID_DATA_INDEX, $value);
    }

    // kind
    public const string KIND = 'kind';
    protected const string KIND_DATA_NAME = 'KIND';
    protected const int KIND_DATA_INDEX = 16;

    public ?string $kind {
        get => $this->getData(self::KIND_DATA_INDEX);
        set => $this->setData(self::KIND_DATA_INDEX, $value);
    }

    // link
    public const string LINK = 'link';
    protected const string LINK_DATA_NAME = 'LINK';
    protected const int LINK_DATA_INDEX = 17;

    public ?string $link {
        get => $this->getData(self::LINK_DATA_INDEX);
        set => $this->setData(self::LINK_DATA_INDEX, $value);
    }

    // mpn
    public const string MPN = 'mpn';
    protected const string MPN_DATA_NAME = 'MPN';
    protected const int MPN_DATA_INDEX = 18;

    public ?string $mpn {
        get => $this->getData(self::MPN_DATA_INDEX);
        set => $this->setData(self::MPN_DATA_INDEX, $value);
    }

    // offerId
    public const string OFFER_ID = 'offerId';
    protected const string OFFER_ID_DATA_NAME = 'OFFER_ID';
    protected const int OFFER_ID_DATA_INDEX = 19;

    public ?string $offerId {
        get => $this->getData(self::OFFER_ID_DATA_INDEX);
        set => $this->setData(self::OFFER_ID_DATA_INDEX, $value);
    }

    // price
    #[PropertyTypeAttribute(PriceTransfer::class)]
    public const string PRICE = 'price';
    protected const string PRICE_DATA_NAME = 'PRICE';
    protected const int PRICE_DATA_INDEX = 20;

    public ?PriceTransfer $price {
        get => $this->getData(self::PRICE_DATA_INDEX);
        set => $this->setData(self::PRICE_DATA_INDEX, $value);
    }

    // sizes
    #[ArrayPropertyTypeAttribute]
    public const string SIZES = 'sizes';
    protected const string SIZES_DATA_NAME = 'SIZES';
    protected const int SIZES_DATA_INDEX = 21;

    /** @var array<int|string,mixed> */
    public array $sizes {
        get => $this->getRequiredData(self::SIZES_DATA_INDEX);
        set => $this->setData(self::SIZES_DATA_INDEX, $value);
    }

    // source
    public const string SOURCE = 'source';
    protected const string SOURCE_DATA_NAME = 'SOURCE';
    protected const int SOURCE_DATA_INDEX = 22;

    public ?string $source {
        get => $this->getData(self::SOURCE_DATA_INDEX);
        set => $this->setData(self::SOURCE_DATA_INDEX, $value);
    }

    // targetCountry
    public const string TARGET_COUNTRY = 'targetCountry';
    protected const string TARGET_COUNTRY_DATA_NAME = 'TARGET_COUNTRY';
    protected const int TARGET_COUNTRY_DATA_INDEX = 23;

    public ?string $targetCountry {
        get => $this->getData(self::TARGET_COUNTRY_DATA_INDEX);
        set => $this->setData(self::TARGET_COUNTRY_DATA_INDEX, $value);
    }

    // title
    public const string TITLE = 'title';
    protected const string TITLE_DATA_NAME = 'TITLE';
    protected const int TITLE_DATA_INDEX = 24;

    public ?string $title {
        get => $this->getData(self::TITLE_DATA_INDEX);
        set => $this->setData(self::TITLE_DATA_INDEX, $value);
    }
}
